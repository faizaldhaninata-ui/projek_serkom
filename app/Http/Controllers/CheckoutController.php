<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // Halaman Utama Checkout
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/toko')->with('error', 'Keranjang kamu masih kosong!');
        }

        return view('checkout', compact('cart'));
    }

    // Proses Transaksi Checkout
    public function proses(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/toko')->with('error', 'Keranjang kamu masih kosong!');
        }

        // 1. Hitung Total Bayar
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['harga'] * $item['qty']);
        }

        // 2. Generate ID Invoice Unik
        $orderId = 'INV-' . strtoupper(Str::random(8));

        // 3. Format Data Transaksi
        $orderData = [
            'id'                => $orderId,
            'kode_transaksi'    => $orderId,
            'nama'              => $request->input('nama'),
            'nama_pemesan'      => $request->input('nama'),
            'telepon'           => $request->input('whatsapp'),
            'whatsapp'          => $request->input('whatsapp'),
            'alamat'            => $request->input('alamat'),
            'metode_pembayaran' => strtoupper($request->input('metode_pembayaran', 'QRIS')),
            'items'             => $cart,
            'total'             => $total,
            'created_at'        => date('d M Y, H:i')
        ];

        // 4. Simpan ke Session Admin & Nota
        $orders = session('orders_db', []);
        $orders[$orderId] = $orderData;

        session([
            'orders_db'       => $orders,
            'transaksi_aktif' => $orderData
        ]);

        // 5. Kosongkan Keranjang Belanja
        session()->forget('cart');

        // 6. Redirect ke Halaman Nota
        return redirect()->route('nota.show', ['kode' => $orderId]);
    }
}