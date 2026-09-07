<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body { 
            font-family: system-ui, -apple-system, sans-serif; 
            padding: 40px 20px; 
            background: #f8fafc; 
            color: #1e293b; 
            line-height: 1.5;
        }

        .container { 
            max-width: 600px; 
            margin: auto; 
            background: white; 
            padding: 28px; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1); 
        }

        h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #0f172a;
        }

        .form-group { 
            margin-bottom: 18px; 
        }

        label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
        }

        input, textarea { 
            width: 100%; 
            padding: 10px 12px; 
            border: 1px solid #cbd5e1; 
            border-radius: 6px; 
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .file-box {
            background: #f1f5f9; 
            padding: 16px; 
            border-radius: 8px; 
            border: 1px solid #cbd5e1;
        }

        .img-preview { 
            width: 80px; 
            height: 80px; 
            object-fit: cover; 
            border-radius: 6px; 
            border: 1px solid #cbd5e1; 
            margin-top: 6px; 
            display: block; 
        }

        .action-buttons {
            display: flex;
            align-items: center;
            margin-top: 24px;
        }

        .btn-simpan { 
            background: #3b82f6; 
            color: white; 
            padding: 10px 18px; 
            border: none; 
            border-radius: 6px; 
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer; 
            transition: background 0.2s;
        }

        .btn-simpan:hover {
            background: #2563eb;
        }

        .btn-batal {
            margin-left: 16px; 
            color: #ef4444; 
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        .btn-batal:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Data Produk</h2>
        
        <form action="/toko/update/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>

            <!-- Input Foto Baru & Preview Foto Saat Ini -->
            <div class="form-group file-box">
                <label style="font-weight: 600; color: #0f172a;">Ganti Foto Produk</label>
                
                @if($produk->foto)
                    <div style="margin-bottom: 12px;">
                        <img src="{{ asset($produk->foto) }}" alt="Foto Produk" class="img-preview">
                        <small style="color: #64748b; font-style: italic; display: block; margin-top: 4px;">Foto saat ini</small>
                    </div>
                @else
                    <p style="font-size: 13px; color: #dc2626; margin: 4px 0 10px 0; font-style: italic;">Belum ada foto yang diunggah.</p>
                @endif

                <input type="file" id="foto" name="foto" accept="image/*" style="background: white;">
                <small style="color: #64748b; display: block; margin-top: 6px;">*Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn-simpan">Update Produk</button>
                <a href="/admin" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>