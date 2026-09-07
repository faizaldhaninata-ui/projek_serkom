<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| HELPER & INISIALISASI USER
|--------------------------------------------------------------------------
*/
function getUsers() {
    if (!session()->has('users_db')) {
        session(['users_db' => [
            'superadmin' => ['password' => 'super123', 'role' => 'superadmin', 'nama' => 'Bos Faizal'],
            'admin'      => ['password' => 'admin1234', 'role' => 'admin', 'nama' => 'Staf Admin'],
            'customer'   => ['password' => 'user123', 'role' => 'customer', 'nama' => 'Pelanggan Setia']
        ]]);
    }
    return session('users_db');
}

/*
|--------------------------------------------------------------------------
| 1. FRONTEND & KATALOG TOKO
|--------------------------------------------------------------------------
*/

// Halaman Profil / Portofolio
Route::get('/', function () {
    return view('profil');
});

// Halaman Utama Katalog Toko
Route::get('/toko', function () {
    $produk = DB::table('produk')->get();
    return view('toko', compact('produk'));
});

/*
|--------------------------------------------------------------------------
| 2. SISTEM KERANJANG & CHECKOUT
|--------------------------------------------------------------------------
*/

// Tambah Produk ke Keranjang
Route::get('/cart/tambah/{id}', function ($id) {
    $produk = DB::table('produk')->where('id', $id)->first();
    if (!$produk) return redirect('/toko')->with('error', 'Produk tidak ditemukan!');

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $cart[$id] = [
            'id'    => $produk->id,
            'nama'  => $produk->nama_produk,
            'harga' => $produk->harga,
            'qty'   => 1
        ];
    }

    session()->put('cart', $cart);
    return redirect('/toko')->with('success', 'Produk berhasil masuk keranjang!');
});

// Update Jumlah Item Keranjang
Route::post('/cart/update', function (Request $request) {
    $cart = session()->get('cart', []);
    if ($request->has('qty')) {
        foreach ($request->qty as $id => $quantity) {
            if (isset($cart[$id])) {
                if ($quantity <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['qty'] = (int)$quantity;
                }
            }
        }
    }
    session()->put('cart', $cart);
    return back();
});

// Hapus Item dari Keranjang
Route::get('/cart/hapus/{id}', function ($id) {
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return back()->with('success', 'Barang dihapus dari keranjang.');
});

// Route Checkout via Controller
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');

// Route Halaman Nota Transaksi
Route::get('/nota/{kode}', function ($kode) {
    $orders = session('orders_db', []);
    $transaksi = $orders[$kode] ?? session('transaksi_aktif');

    if (!$transaksi) {
        return redirect('/toko')->with('error', 'Nota transaksi tidak ditemukan!');
    }

    return view('nota', compact('transaksi', 'kode'));
})->name('nota.show');

/*
|--------------------------------------------------------------------------
| 3. AUTENTIKASI (LOGIN & LOGOUT)
|--------------------------------------------------------------------------
*/

// Halaman Form Login
Route::get('/login', function () {
    getUsers();
    return view('login');
});

// Proses Autentikasi Login
Route::post('/login', function (Request $request) {
    $users = getUsers();
    $u = $request->username;
    $p = $request->password;

    if (array_key_exists($u, $users) && $users[$u]['password'] == $p) {
        session([
            'is_logged_in' => true,
            'username'     => $u,
            'role'         => $users[$u]['role'],
            'nama'         => $users[$u]['nama']
        ]);
        
        return redirect($users[$u]['role'] == 'customer' ? '/toko' : '/admin');
    }
    return back()->with('error', 'Username atau Password salah!');
});

// Proses Logout
Route::get('/logout', function () {
    session()->forget(['is_logged_in', 'role', 'nama', 'username']);
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| 4. DASHBOARD ADMIN & MANAJEMEN DATA
|--------------------------------------------------------------------------
*/

// Dashboard Utama Admin
Route::get('/admin', function () {
    if (!session('is_logged_in') || session('role') == 'customer') return redirect('/login');
    
    $produk = DB::table('produk')->orderBy('id', 'desc')->get();
    $users = getUsers();
    $orders = session('orders_db', []);
    return view('admin', compact('produk', 'users', 'orders'));
});

// Tambah Produk Baru
Route::post('/toko/tambah', function (Request $request) {
    if (!session('is_logged_in') || session('role') == 'customer') {
        return redirect('/login');
    }
    
    $fotoPath = null;

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $fotoPath = 'uploads/' . $filename;
    }

    DB::table('produk')->insert([
        'nama_produk' => $request->nama_produk,
        'harga'       => $request->harga,
        'deskripsi'   => $request->deskripsi,
        'foto'        => $fotoPath
    ]);

    return redirect('/admin')->with('success', 'Produk dan foto berhasil ditambahkan!');
});

// Form Edit Produk
Route::get('/toko/edit/{id}', function ($id) {
    if (!session('is_logged_in') || session('role') == 'customer') return redirect('/login');
    
    $produk = DB::table('produk')->where('id', $id)->first();
    return view('edit', compact('produk'));
});

// Update Data Produk
Route::post('/toko/update/{id}', function (Request $request, $id) {
    if (!session('is_logged_in') || session('role') == 'customer') {
        return redirect('/login');
    }
    
    $produk = DB::table('produk')->where('id', $id)->first();
    $fotoPath = $produk->foto; 

    if ($request->hasFile('foto')) {
        if ($produk->foto && file_exists(public_path($produk->foto))) {
            unlink(public_path($produk->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $fotoPath = 'uploads/' . $filename;
    }

    DB::table('produk')->where('id', $id)->update([
        'nama_produk' => $request->nama_produk,
        'harga'       => $request->harga,
        'deskripsi'   => $request->deskripsi,
        'foto'        => $fotoPath
    ]);

    return redirect('/admin')->with('success', 'Produk berhasil diperbarui!');
});

// Hapus Produk (Khusus Superadmin)
Route::get('/toko/hapus/{id}', function ($id) {
    if (session('role') != 'superadmin') {
        return redirect('/admin')->with('error', 'Akses Ditolak!');
    }
    DB::table('produk')->where('id', $id)->delete();
    return redirect('/admin');
});

// Tambah User Admin (Khusus Superadmin)
Route::post('/admin/user/tambah', function (Request $request) {
    if (session('role') != 'superadmin') return redirect('/admin');

    $users = getUsers();
    $newUsername = strtolower(trim($request->username));

    if (array_key_exists($newUsername, $users)) {
        return redirect('/admin')->with('error', 'Username sudah terpakai!');
    }

    $users[$newUsername] = [
        'password' => $request->password,
        'role'     => 'admin',
        'nama'     => $request->nama
    ];

    session(['users_db' => $users]);
    return redirect('/admin')->with('success', 'Admin baru berhasil ditambahkan!');
});

// Hapus User Admin (Khusus Superadmin)
Route::get('/admin/user/hapus/{username}', function ($username) {
    if (session('role') != 'superadmin' || $username == session('username') || $username == 'superadmin') {
        return redirect('/admin');
    }

    $users = getUsers();
    if (isset($users[$username])) {
        unset($users[$username]);
        session(['users_db' => $users]);
    }

    return redirect('/admin')->with('success', 'User Admin berhasil dihapus!');
});