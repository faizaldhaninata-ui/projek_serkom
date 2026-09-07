<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FZLDHNNTA Merch</title>
    
    <style>
        /* CSS Variables - Selaras dengan Tema Toko */
        :root {
            --bg-primary: #09090b;
            --bg-card: #121215;
            --bg-input: #18181b;
            --text-primary: #f4f4f5;
            --text-secondary: #a1a1aa;
            --border-color: #27272a;
            --accent-color: #0ea5e9;
            --accent-hover: #0284c7;
            --danger-bg: #451a1a;
            --danger-border: #7f1d1d;
            --danger-text: #fca5a5;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Container Card Login */
        .login-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 32px 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .login-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .login-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 0.88rem;
            color: var(--text-secondary);
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-secondary);
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            background-color: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
        }

        /* Tombol Utama */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: var(--accent-hover);
        }

        /* Alert Pesan Error */
        .alert-error {
            background-color: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Navigasi Kembali */
        .nav-back {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: var(--text-secondary);
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .nav-back:hover {
            color: var(--accent-color);
        }

        /* Kotak Informasi Akun Demo */
        .demo-box {
            margin-top: 24px;
            padding: 16px;
            background-color: rgba(24, 24, 27, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.82rem;
        }

        .demo-title {
            color: var(--accent-color);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .demo-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
            color: var(--text-secondary);
        }

        .demo-code {
            background-color: #27272a;
            color: #38bdf8;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Header Form -->
        <div class="login-header">
            <h1>Masuk Akun</h1>
            <p>Silakan masuk untuk mengakses layanan toko & admin</p>
        </div>

        <!-- Alert Error Login -->
        @if(session('error'))
            <div class="alert-error">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="Masukkan username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-submit">Masuk Sekarang</button>
        </form>

        <!-- Navigasi Kembali -->
        <a href="/toko" class="nav-back">&larr; Kembali ke Katalog Toko</a>

        <!-- Informasi Akun Demo -->
        <div class="demo-box">
            <div class="demo-title">🔑 Akun Demo & Password</div>
            <ul class="demo-list">
                <li>• <strong>Superadmin:</strong> <span class="demo-code">superadmin</span> / <span class="demo-code">super123</span></li>
                <li>• <strong>Admin:</strong> <span class="demo-code">admin</span> / <span class="demo-code">admin1234</span></li>
                <li>• <strong>Customer:</strong> <span class="demo-code">customer</span> / <span class="demo-code">user123</span></li>
            </ul>
        </div>
    </div>

</body>
</html>