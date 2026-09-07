<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - FZLDHNNTA Merch</title>
    <style>
        :root {
            --bg-primary: #09090b;
            --bg-card: #121215;
            --text-primary: #f4f4f5;
            --text-secondary: #a1a1aa;
            --border-color: #27272a;
            --accent-color: #0ea5e9;
            --input-bg: #18181b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body { 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            background-color: var(--bg-primary); 
            color: var(--text-primary); 
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Navbar Lightweight */
        nav { 
            background-color: var(--bg-card); 
            border-bottom: 1px solid var(--border-color); 
            padding: 15px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        /* Container Layout */
        .container {
            max-width: 1100px;
            width: 100%;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .btn-back {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 24px;
            transition: opacity 0.2s;
        }

        .btn-back:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--text-primary);
        }

        /* Grid Layout */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        @media (min-width: 850px) {
            .checkout-grid {
                grid-template-columns: 1.4fr 1fr;
            }
        }

        /* Card Style */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 28px;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.2);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            cursor: pointer;
        }

        /* Ringkasan Pesanan Style */
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px dashed var(--border-color);
            font-size: 0.92rem;
        }

        .order-item-title {
            font-weight: 600;
            color: var(--text-primary);
        }

        .order-item-price {
            font-weight: 700;
            color: var(--text-primary);
            text-align: right;
            white-space: nowrap;
            margin-left: 15px;
        }

        .total-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .total-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .total-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--accent-color);
        }

        .btn-submit {
            width: 100%;
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 24px;
            transition: background-color 0.2s ease, transform 0.1s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <nav>
        <a href="/toko" style="display: inline-flex; align-items: center; gap: 12px; text-decoration: none; color: white; font-size: 20px; font-weight: bold;">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="height: 45px; width: auto; object-fit: contain;">
            <span>FZLDHNNTA Merch</span>
        </a>
    </nav>

    <div class="container">
        <a href="/toko" class="btn-back">&larr; Kembali ke Toko</a>
        
        <h1 class="page-title">Pengiriman & Pembayaran</h1>

        <form action="/checkout/proses" method="POST">
            @csrf
            <div class="checkout-grid">
                
                <!-- Form Data Pembeli -->
                <div class="card">
                    <h2 class="card-header">Data Pembeli</h2>
                    
                    <div class="form-group">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Pelanggan Setia" value="{{ old('nama', session('user_nama', '')) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="whatsapp">Nomor WhatsApp</label>
                        <input type="tel" id="whatsapp" name="whatsapp" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="alamat">Alamat Lengkap Pengiriman</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Jl. Merdeka No. 123..." required></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="metode_pembayaran">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" class="form-control" required>
                            <option value="qris">QRIS / All E-Wallet</option>
                            <option value="bca">Transfer Bank BCA</option>
                            <option value="mandiri">Transfer Bank Mandiri</option>
                            <option value="cod">Bayar di Tempat (COD)</option>
                        </select>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div>
                    <div class="card">
                        <h2 class="card-header">Ringkasan Pesanan</h2>
                        
                        @php 
                            $cart = session('cart', []); 
                            $grandTotal = 0; 
                        @endphp
                        
                        <div style="max-height: 280px; overflow-y: auto; padding-right: 4px;">
                            @forelse($cart as $item)
                                @php 
                                    $subtotal = $item['harga'] * $item['qty']; 
                                    $grandTotal += $subtotal; 
                                @endphp
                                <div class="order-item">
                                    <div>
                                        <div class="order-item-title">{{ $item['nama'] }}</div>
                                        <div style="color: var(--text-secondary); font-size: 0.8rem;">(x{{ $item['qty'] }})</div>
                                    </div>
                                    <div class="order-item-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                </div>
                            @empty
                                <p style="color: var(--text-secondary); text-align: center; padding: 10px 0;">Tidak ada pesanan.</p>
                            @endforelse
                        </div>

                        <div class="total-container">
                            <span class="total-title">Total Bayar:</span>
                            <span class="total-price">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="btn-submit">
                            🔒 Buat Pesanan Sekarang
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Footer Informasi -->
    <footer style="background-color: #000000; color: #a1a1aa; padding: 25px 20px; border-top: 1px solid var(--border-color); text-align: center; font-size: 13px; margin-top: 40px;">
        &copy; 2026 FZLDHNNTA Merch. All rights reserved.
    </footer>

</body>
</html>