<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Merch Band</title>
    <style>
        body { font-family: sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .container { max-width: 900px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cbd5e1; padding: 12px; text-align: left; }
        th { background: #0f172a; color: white; }
        .btn { padding: 8px 12px; text-decoration: none; color: white; border-radius: 4px; font-size: 14px; border: none; cursor: pointer; display: inline-block; }
        .btn-tambah { background: #16a34a; }
        .btn-edit { background: #eab308; color: black; }
        .btn-hapus { background: #dc2626; }
        .form-group { margin-bottom: 12px; }
        input, textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .badge-role { background: #38bdf8; padding: 4px 10px; border-radius: 20px; font-size: 12px; color: #0f172a; font-weight: bold; }
        .section-box { background: #f1f5f9; padding: 20px; border-radius: 8px; margin-top: 35px; border: 1px solid #cbd5e1; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Panel Admin -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Panel Admin - Kelola Produk (CRUD)</h2>
            <a href="/logout" class="btn btn-hapus">Logout</a>
        </div>
        
        <p>
            Halo, <strong>{{ session('nama') }}</strong>! 
            <span class="badge-role">Role: {{ strtoupper(session('role')) }}</span>
        </p>

        <!-- Alert Error -->
        @if(session('error'))
            <div style="background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f87171;">
                <strong>Peringatan:</strong> {{ session('error') }}
            </div>
        @endif

        <!-- Alert Success -->
        @if(session('success'))
            <div style="background: #dcfce7; color: #15803d; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #86efac;">
                <strong>Sukses:</strong> {{ session('success') }}
            </div>
        @endif

        <p>
            <a href="/toko">Lihat Hasil di Web Toko</a> | 
            <a href="/">Kembali ke Profil</a>
        </p>
        <hr>

        <!-- ========================================== -->
        <!-- FORM TAMBAH PRODUK                         -->
        <!-- ========================================== -->
        <h3>Tambah Produk Baru</h3>
        <form action="/toko/tambah" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="nama_produk" placeholder="Nama Merch (Contoh: Kaos Dewa 19)" required>
            </div>
            <div class="form-group">
                <input type="number" name="harga" placeholder="Harga (Hanya angka, contoh: 150000)" required>
            </div>
            <div class="form-group">
                <textarea name="deskripsi" placeholder="Deskripsi Bahan & Kualitas" required rows="3"></textarea>
            </div>
            
            <!-- Input Foto Produk -->
            <div class="form-group">
                <label style="font-size: 14px; font-weight: bold; margin-bottom: 5px; display: block;">Foto Produk:</label>
                <input type="file" name="foto" accept="image/*" style="padding: 5px;">
                <small style="color: gray; display: block; margin-top: 5px;">Format: JPG, JPEG, PNG</small>
            </div>

            <button type="submit" class="btn btn-tambah" style="margin-top: 10px;">Simpan ke Database</button>
        </form>

        <!-- ========================================== -->
        <!-- TABEL DAFTAR PRODUK                        -->
        <!-- ========================================== -->
        <h3 style="margin-top: 40px;">Daftar Produk di Database</h3>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $p)
                    <tr>
                        <!-- Tampilan Foto -->
                        <td style="text-align: center; width: 90px;">
                            @if($p->foto)
                                <img src="{{ asset($p->foto) }}" alt="Foto {{ $p->nama_produk }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                            @else
                                <span style="font-size: 11px; color: #dc2626; font-style: italic;">No Image</span>
                            @endif
                        </td>
                        
                        <td>{{ $p->nama_produk }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td>
                            <a href="/toko/edit/{{ $p->id }}" class="btn btn-edit" style="margin-bottom: 5px; display: block; text-align: center;">Edit</a>
                            
                            @if(session('role') == 'superadmin')
                                <a href="/toko/hapus/{{ $p->id }}" class="btn btn-hapus" style="display: block; text-align: center;" onclick="return confirm('Lu yakin mau hapus barang ini king?')">Hapus</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ========================================== -->
        <!-- FITUR KHUSUS KINK SUPERADMIN                    -->
        <!-- ========================================== -->
        @if(session('role') == 'superadmin')
            <div class="section-box">
                <h3 style="margin-top: 0;">👑 Kelola User Admin (Khusus Super Admin)</h3>
                <p style="font-size: 13px; color: #475569;">Superadmin bisa menambahkan admin baru atau menghapus admin biasa di bawah ini king.</p>

                <form action="/admin/user/tambah" method="POST" style="margin-bottom: 20px;">
                    @csrf
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="nama" placeholder="Nama Admin Baru" required style="flex: 1;">
                        <input type="text" name="username" placeholder="Username" required style="flex: 1;">
                        <input type="password" name="password" placeholder="Password" required style="flex: 1;">
                        <button type="submit" class="btn btn-tambah" style="white-space: nowrap;">+ Tambah Admin</button>
                    </div>
                </form>

                <h4 style="margin-bottom: 10px;">Daftar User Sistem:</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $uname => $u)
                            <tr>
                                <td>{{ $u['nama'] }}</td>
                                <td><code>{{ $uname }}</code></td>
                                <td><span class="badge-role">{{ strtoupper($u['role']) }}</span></td>
                                <td>
                                    @if($u['role'] != 'superadmin' && $uname != session('username'))
                                        <a href="/admin/user/hapus/{{ $uname }}" class="btn btn-hapus" onclick="return confirm('Yakin mau hapus admin {{ $u['nama'] }} ini king?')">Hapus Admin</a>
                                    @else
                                        <span style="font-size: 12px; color: #64748b; font-style: italic;">Utama / Diri Sendiri</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</body>
</html>