<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Merch - FZLDHNNTA</title>
    
    <style>
        /* CSS Variables untuk Tema Gelap / Terang */
        :root {
            --bg-primary: #09090b;
            --bg-card: #121215;
            --text-primary: #f4f4f5;
            --text-secondary: #a1a1aa;
            --border-color: #27272a;
            --accent-color: #0ea5e9;
        }

        body.dark-theme {
            --bg-primary: #09090b;
            --bg-card: #121215;
            --text-primary: #f4f4f5;
            --text-secondary: #a1a1aa;
            --border-color: #27272a;
        }

        /* Reset & Style Umum */
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
        }

        /* Navbar & Header */
        nav { 
            background-color: var(--bg-card); 
            border-bottom: 1px solid var(--border-color); 
            padding: 15px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: relative;
        }

        /* Tombol Hamburger Garis Tiga */
        .hamburger-btn {
            background: #1e1e24;
            border: 1px solid #3f3f46;
            color: white;
            font-size: 1.4rem;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .hamburger-btn:hover {
            background-color: #27272a;
            border-color: #52525b;
        }

        /* Dropdown Menu Navigasi */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 75px;
            right: 30px;
            background-color: #121215;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            padding: 8px;
            width: 220px;
            z-index: 999;
            flex-direction: column;
            gap: 4px;
        }

        .dropdown-menu.show {
            display: flex;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 14px;
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            background: transparent;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
            transition: background 0.2s;
        }

        .dropdown-item:hover {
            background-color: #1e1e24;
        }

        .badge-cart {
            background-color: #ef4444;
            color: white;
            font-size: 0.75rem;
            border-radius: 50%;
            padding: 2px 7px;
        }

        /* Layout Utama & Hero Section */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .hero {
            text-align: center;
            margin-bottom: 35px;
        }

        .hero h1 {
            font-size: 2.2rem;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .hero p {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* Grid Produk (4 Kolom pada Layar Besar) */
        .grid-produk {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        @media (min-width: 1024px) {
            .grid-produk {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Card Produk */
        .card { 
            background-color: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 12px; 
            overflow: hidden; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: #3f3f46;
        }

        .card-img-container { 
            width: 100%; 
            height: 220px; 
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .card-img-container img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
        }

        .card-badge {
            font-size: 0.7rem;
            color: #38bdf8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 12px 12px 4px;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 12px 6px;
            line-height: 1.3;
        }

        .card-desc {
            font-size: 0.82rem;
            color: var(--text-secondary);
            margin: 0 12px 15px;
            line-height: 1.4;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border-top: 1px solid var(--border-color);
            background-color: rgba(0,0,0,0.2);
            margin-top: auto;
        }

        .price {
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .btn-buy {
            background-color: var(--accent-color);
            color: white;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.82rem;
            border: none;
            cursor: pointer;
        }

        .btn-buy:hover {
            opacity: 0.9;
        }

        /* Modal Keranjang Belanja */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            padding: 24px;
            color: var(--text-primary);
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-qty-input {
            width: 50px;
            padding: 4px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- NAVBAR TINGKAT ATAS -->
    <nav>
        <a href="/toko" style="display: inline-flex; align-items: center; gap: 12px; text-decoration: none; color: white; font-size: 20px; font-weight: bold;">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="height: 55px; width: auto; object-fit: contain;">
            <span>FZLDHNNTA Merch</span>
        </a>
            
        <!-- Menu Navigasi Hamburger -->
        <div>
            <button class="hamburger-btn" onclick="toggleMenu(event)" aria-label="Menu">
                ☰
            </button>

            <div class="dropdown-menu" id="dropdownMenu">
                @if(session('is_logged_in') && session('role') != 'customer')
                    <a href="/admin" class="dropdown-item" style="color: #38bdf8;">
                        <span>📊 Dashboard Admin</span>
                    </a>
                @endif

                <button class="dropdown-item" onclick="openCart(); closeMenu();">
                    <span>🛒 Keranjang</span>
                    @php $cartCount = array_sum(array_column(session('cart', []), 'qty')); @endphp
                    @if($cartCount > 0)
                        <span class="badge-cart">{{ $cartCount }}</span>
                    @endif
                </button>

                <button id="themeToggle" class="dropdown-item" onclick="toggleTheme()">
                    <span id="themeText">🌙 Mode Gelap</span>
                </button>

                <hr style="border: 0; border-top: 1px solid #27272a; margin: 4px 0;">

                @if(session('is_logged_in'))
                    <a href="/logout" class="dropdown-item" style="color: #ef4444;">🚪 Logout</a>
                @else
                    <a href="/login" class="dropdown-item" style="color: #38bdf8;">🔑 Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="container">
        @if(session('success'))
            <div style="background: #166534; color: #f0fdf4; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; border: 1px solid #22c55e;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="hero">
            <h1>Official Merch Store</h1>
            <p>Koleksi merchandise eksklusif dan original dari band lokal.</p>
        </div>

        <!-- LIST KATALOG PRODUK -->
        <div class="grid-produk">
            @forelse($produk as $p)
                <div class="card">
                    <div>
                        <div class="card-img-container">
                            @if($p->foto)
                                <img src="{{ asset($p->foto) }}" alt="{{ $p->nama_produk }}">
                            @else
                                <span style="color: var(--text-secondary); font-size: 0.85rem;">Tidak Ada Foto</span>
                            @endif
                        </div>
                        <div class="card-badge">Official Merch</div>
                        <h3 class="card-title">{{ $p->nama_produk }}</h3>
                        <p class="card-desc">{{ $p->deskripsi }}</p>
                    </div>
                    <div class="card-footer">
                        <span class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                        <a href="/cart/tambah/{{ $p->id }}" class="btn-buy">+ Keranjang</a>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">Belum ada produk dirilis.</p>
            @endforelse
        </div>
    </div>

    <!-- MODAL KERANJANG BELANJA -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 16px;">
                <h3 style="font-size: 1.2rem;">🛒 Keranjang Belanja</h3>
                <button onclick="closeCart()" style="background:none; border:none; color:var(--text-primary); font-size:1.5rem; cursor:pointer;">&times;</button>
            </div>

            @php $cart = session('cart', []); $grandTotal = 0; @endphp
            @if(count($cart) > 0)
                <form action="/cart/update" method="POST">
                    @csrf
                    <div style="max-height: 250px; overflow-y: auto; margin-bottom: 15px;">
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['harga'] * $item['qty']; $grandTotal += $subtotal; @endphp
                            <div class="cart-item">
                                <div>
                                    <div style="font-weight: 600;">{{ $item['nama'] }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary);">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                </div>
                                <div style="display:flex; align-items:center; gap: 8px;">
                                    <input type="number" name="qty[{{ $id }}]" value="{{ $item['qty'] }}" min="1" class="cart-qty-input">
                                    <a href="/cart/hapus/{{ $id }}" style="color:#ef4444; text-decoration:none; font-weight:bold;">✕</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary); padding: 8px 12px; border-radius: 6px; cursor: pointer; width: 100%; margin-bottom: 15px; font-weight:600;">Update Jumlah Barang</button>
                </form>

                <div style="display:flex; justify-content:space-between; font-weight:700; font-size: 1.1rem; border-top:1px dashed var(--border-color); padding-top: 12px; margin-bottom:20px;">
                    <span>Total:</span>
                    <span style="color:var(--accent-color);">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>

                <a href="/checkout" class="btn-buy" style="display:block; text-align:center; padding: 12px;">Lanjut ke Checkout &rarr;</a>
            @else
                <p style="text-align:center; color:var(--text-secondary); padding: 30px 0;">Keranjang kamu masih kosong!</p>
            @endif
        </div>
    </div>

    <!-- FOOTER KONTAK & INFORMASI TOKO -->
    <footer style="background-color: #000000; color: #a1a1aa; padding: 40px 20px 20px; margin-top: 60px; border-top: 1px solid #27272a;">
        <div style="max-width: 1280px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 30px;">
            <div style="flex: 1; min-width: 250px;">
                <h3 style="color: #ffffff; margin-top: 0; margin-bottom: 15px; font-size: 18px;">FZLDHNNTA Merch</h3>
                <p style="font-size: 14px; line-height: 1.6; margin: 0;">
                    Official merchandise store eksklusif. Dukung terus karya original dengan membeli produk resmi dan berkualitas langsung dari kami.
                </p>
            </div>
            <div style="flex: 1; min-width: 250px;">
                <h3 style="color: #ffffff; margin-top: 0; margin-bottom: 15px; font-size: 18px;">Layanan Pelanggan</h3>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 14px; line-height: 2;">
                    <li>📞 <strong>Telepon:</strong> <a href="tel:+6283166181612" style="color: #38bdf8; text-decoration: none;">+62 831-6618-1612</a></li>
                    <li>💬 <strong>WhatsApp:</strong> <a href="https://wa.me/6283166181612" target="_blank" style="color: #38bdf8; text-decoration: none;">+62 831-6618-1612</a></li>
                    <li>✉️ <strong>Email:</strong> <a href="mailto:faizaldhaninata@gmail.com" style="color: #38bdf8; text-decoration: none;">faizaldhaninata@gmail.com</a></li>
                </ul>
            </div>
        </div>
        <div style="text-align: center; font-size: 13px; margin-top: 40px; padding-top: 20px; border-top: 1px solid #27272a; color: #52525b;">
            &copy; 2026 FZLDHNNTA Merch. All rights reserved.
        </div>
    </footer>

    <!-- JAVASCRIPT KONTROL UI -->
    <script>
        // Modal Keranjang
        function openCart() { document.getElementById('cartModal').style.display = 'flex'; }
        function closeCart() { document.getElementById('cartModal').style.display = 'none'; }

        // Dropdown Menu Garis Tiga
        function toggleMenu(event) {
            event.stopPropagation();
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('show');
        }

        function closeMenu() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.remove('show');
        }

        // Tutup menu otomatis jika mengeklik di luar area menu
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('dropdownMenu');
            const btn = document.querySelector('.hamburger-btn');
            if (menu && !menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.remove('show');
            }
        });

        // Toggle Tema Dark / Light
        function initTheme() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.body.classList.add('dark-theme');
                updateToggleButton(true);
            } else {
                document.body.classList.remove('dark-theme');
                updateToggleButton(false);
            }
        }

        function toggleTheme() {
            const isDark = document.body.classList.toggle('dark-theme');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateToggleButton(isDark);
        }

        function updateToggleButton(isDark) {
            document.getElementById('themeText').textContent = isDark ? '☀️ Mode Terang' : '🌙 Mode Gelap';
        }

        initTheme();
    </script>
</body>
</html>