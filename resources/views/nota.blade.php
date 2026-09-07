<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        // Pembacaan Data Fleksibel (Object/Array/Model)
        $kodeNota = data_get($transaksi, 'kode_transaksi') 
                 ?? data_get($transaksi, 'no_nota') 
                 ?? data_get($transaksi, 'kode') 
                 ?? $kode 
                 ?? request()->segment(2) 
                 ?? 'INV-000000';

        $namaPembeli = data_get($transaksi, 'nama') 
                    ?? data_get($transaksi, 'nama_pembeli') 
                    ?? data_get($transaksi, 'nama_lengkap') 
                    ?? data_get($transaksi, 'nama_pelanggan') 
                    ?? $nama 
                    ?? session('user_nama') 
                    ?? 'Pelanggan';

        $noWA = data_get($transaksi, 'whatsapp') 
             ?? data_get($transaksi, 'no_whatsapp') 
             ?? data_get($transaksi, 'no_hp') 
             ?? data_get($transaksi, 'nohp') 
             ?? $whatsapp 
             ?? '-';

        $alamatPengiriman = data_get($transaksi, 'alamat') 
                         ?? data_get($transaksi, 'alamat_pengiriman') 
                         ?? data_get($transaksi, 'alamat_lengkap') 
                         ?? $alamat 
                         ?? '-';

        $metodeBayar = data_get($transaksi, 'metode_pembayaran') 
                    ?? data_get($transaksi, 'metode') 
                    ?? $metode 
                    ?? 'QRIS';

        $createdDate = data_get($transaksi, 'created_at');
    @endphp

    <title>Nota #{{ $kodeNota }} - FZLDHNNTA Merch</title>
    
    <style>
        :root {
            --bg-primary: #09090b;
            --bg-card: #121215;
            --text-primary: #f4f4f5;
            --text-secondary: #a1a1aa;
            --border-color: #27272a;
            --accent-color: #0ea5e9;
            --green-success: #22c55e;
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

        nav { 
            background-color: var(--bg-card); 
            border-bottom: 1px solid var(--border-color); 
            padding: 15px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .container {
            max-width: 680px;
            width: 100%;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card-nota {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 32px 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .nota-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .nota-header h2 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .nota-header .subtitle {
            font-size: 0.88rem;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }

        .invoice-badge {
            display: inline-block;
            background-color: #18181b;
            border: 1px solid var(--border-color);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-secondary);
        }

        .invoice-badge span {
            color: var(--green-success);
        }

        .divider {
            border: 0;
            border-top: 1px dashed var(--border-color);
            margin: 20px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 20px;
            font-size: 0.88rem;
            margin-bottom: 20px;
        }

        @media (max-width: 500px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.82rem;
        }

        .info-value {
            color: var(--text-primary);
            font-weight: 600;
            word-break: break-word;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-bottom: 20px;
        }

        .nota-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .nota-table th {
            text-align: left;
            padding: 10px 8px;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.82rem;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
        }

        .nota-table td {
            padding: 14px 8px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0 24px;
            font-weight: 700;
        }

        .total-label {
            font-size: 1.05rem;
            color: var(--text-primary);
        }

        .total-amount {
            font-size: 1.3rem;
            color: var(--green-success);
            font-weight: 800;
        }

        .btn-wa {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            background-color: var(--green-success);
            color: #ffffff;
            text-decoration: none;
            padding: 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: opacity 0.2s, transform 0.1s;
        }

        .btn-wa:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        .btn-back-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            transition: color 0.2s;
        }

        .btn-back-link:hover {
            color: var(--text-primary);
            text-decoration: underline;
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
        <div class="card-nota">
            
            <div class="nota-header">
                <h2>FZLDHNNTA Merch</h2>
                <p class="subtitle">Bukti Pemesanan Merchandise Resmi</p>
                <div class="invoice-badge">
                    ID: <span>{{ $kodeNota }}</span>
                </div>
            </div>

            <hr class="divider">

            <!-- Detail Pembeli -->
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Pembeli:</span>
                    <span class="info-value">{{ $namaPembeli }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal:</span>
                    <span class="info-value">
                        {{ $createdDate ? \Carbon\Carbon::parse($createdDate)->translatedFormat('d M Y, H:i') : date('d M Y, H:i') }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">No. HP / WA:</span>
                    <span class="info-value">{{ $noWA }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Metode Pembayaran:</span>
                    <span class="info-value" style="text-transform: uppercase;">{{ $metodeBayar }}</span>
                </div>
                <div class="info-item full-width">
                    <span class="info-label">Alamat Pengiriman:</span>
                    <span class="info-value">{{ $alamatPengiriman }}</span>
                </div>
            </div>

            <!-- Tabel Detail Barang & Total -->
            @php 
                $grandTotal = data_get($transaksi, 'total') 
                           ?? data_get($transaksi, 'total_harga') 
                           ?? data_get($transaksi, 'grand_total') 
                           ?? 0; 
                
                $items = data_get($transaksi, 'detail') 
                      ?? data_get($transaksi, 'items') 
                      ?? $detail 
                      ?? session('cart', []);
            @endphp

            <div class="table-container">
                <table class="nota-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            @php
                                $namaBarang = data_get($item, 'nama_produk') ?? data_get($item, 'nama') ?? data_get($item, 'produk.nama_produk') ?? 'Merchandise';
                                $qtyBarang = data_get($item, 'qty') ?? data_get($item, 'jumlah') ?? 1;
                                $hargaBarang = data_get($item, 'harga') ?? 0;
                                $subtotalBarang = data_get($item, 'subtotal') ?? ($hargaBarang * $qtyBarang);
                                if($grandTotal == 0) { $grandTotal += $subtotalBarang; }
                            @endphp
                            <tr>
                                <td>{{ $namaBarang }}</td>
                                <td style="text-align: center;">{{ $qtyBarang }}</td>
                                <td style="text-align: right;">Rp {{ number_format($subtotalBarang, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-secondary);">Detail pesanan tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="total-row">
                <span class="total-label">Total Pembayaran:</span>
                <span class="total-amount">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>

            <!-- Tombol WhatsApp Dinamis -->
            @php
                $waNumber = "6283166181612";
                $totalFormatted = number_format($grandTotal, 0, ',', '.');
                $pesanWA = "Halo FZLDHNNTA Merch, saya atas nama *{$namaPembeli}* ingin konfirmasi pesanan dengan ID Nota *#{$kodeNota}* sebesar *Rp {$totalFormatted}*. Alamat pengiriman: {$alamatPengiriman}. Mohon diproses.";
                $urlWA = "https://wa.me/" . $waNumber . "?text=" . rawurlencode($pesanWA);
            @endphp

            <a href="{{ $urlWA }}" target="_blank" class="btn-wa">
                📱 Konfirmasi Pesanan via WhatsApp
            </a>

            <a href="/toko" class="btn-back-link">&larr; Kembali Berbelanja</a>

        </div>
    </div>

    <!-- Footer Informasi -->
    <footer style="background-color: #000000; color: #a1a1aa; padding: 25px 20px; border-top: 1px solid var(--border-color); text-align: center; font-size: 13px;">
        &copy; 2026 FZLDHNNTA Merch. All rights reserved.
    </footer>

</body>
</html>