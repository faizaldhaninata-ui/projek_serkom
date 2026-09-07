<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Faizal Dhani Nata - Junior Web Developer</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }
        /* Sidebar */
        .sidebar {
            background-color: #1e3a8a; 
            color: white;
            width: 100%;
            padding: 40px 30px;
            box-sizing: border-box;
            text-align: center;
        }
        @media (min-width: 768px) {
            .sidebar { width: 35%; text-align: left; }
        }
        
        .foto-profil {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            background-color: #e5e7eb; 
        }
        
        .sidebar h2 { font-size: 24px; margin-bottom: 5px; text-transform: uppercase;}
        .sidebar h4 { font-weight: 300; color: #93c5fd; margin-top: 0; margin-bottom: 30px; }
        .sidebar h3 { font-size: 18px; border-bottom: 2px solid #3b82f6; padding-bottom: 5px; margin-top: 30px;}
        
        .kontak-item, .kemampuan-item { margin-bottom: 15px; font-size: 14px;}
        .kontak-item strong { display: block; color: #93c5fd; }
        .kemampuan-item li { margin-bottom: 8px; line-height: 1.4; }

        /* Konten Utama */
        .main-content {
            width: 100%;
            padding: 40px;
            box-sizing: border-box;
        }
        @media (min-width: 768px) {
            .main-content { width: 65%; }
        }

        .main-content h3 {
            color: #1e3a8a;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            margin-top: 0;
            font-size: 20px;
        }
        .main-content p { line-height: 1.8; color: #4b5563; text-align: justify; font-size: 14px;}
        
        .pengalaman { margin-top: 30px; }
        .pengalaman-item { margin-bottom: 25px; }
        .pengalaman-item h4 { margin: 0 0 5px 0; color: #1f2937; }
        .pengalaman-item .perusahaan { font-weight: 600; color: #3b82f6; font-size: 15px;}
        .pengalaman-item .tanggal { color: #6b7280; font-size: 13px; font-style: italic; margin-bottom: 10px; }
        .pengalaman-item ul { padding-left: 20px; margin-top: 10px; }
        .pengalaman-item li { color: #4b5563; margin-bottom: 8px; font-size: 14px; line-height: 1.6;}

        /* Button ke Web Dinamis Toko Merch */
        .btn-usaha-container { text-align: center; margin-top: 40px; }
        .btn-usaha {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
        }
        .btn-usaha:hover { background-color: #059669; }
    </style>
</head>
<body>

    <div class="container">
        <!-- SIDEBAR KIRI -->
        <div class="sidebar">
            <!-- Asset foto profile -->
            <img src="{{ asset('assets/Foto_Faizal_Dhani_Nata.png') }}" alt="Foto Faizal" class="foto-profil">
            
            <h2>Faizal Dhani Nata</h2>
            <h4>Junior Web Developer</h4>

            <h3>Kontak</h3>
            <div class="kontak-item">
                <strong>Email</strong> faizaldhaninata@gmail.com
            </div>
            <div class="kontak-item">
                <strong>No. HP</strong> +62 812-1753-5369
            </div>
            <div class="kontak-item">
                <strong>Instagram</strong> @Zallflrxx_
            </div>
            <div class="kontak-item">
                <strong>Alamat</strong> Jl. Sidomapan, Ngunut, Babadan, Ponorogo.
            </div>

            <h3>Pendidikan</h3>
            <div class="kontak-item">
                <strong>(2024-2026)</strong>
                SMK Negeri 1 Jenangan<br>
                Jurusan Rekayasa Perangkat Lunak
            </div>

            <h3>Kemampuan</h3>
            <ul class="kemampuan-item">
                <li><strong>Web Dev:</strong> HTML, CSS, JavaScript, PHP</li>
                <li><strong>Database:</strong> MySQL/PostgreSQL</li>
                <li><strong>Desain:</strong> UI/UX, Aset Kreatif, Editing</li>
                <li><strong>Tools:</strong> VS Code, Figma, Photoshop/Canva, Git</li>
            </ul>
        </div>

        <!-- KONTEN UTAMA KANAN -->
        <div class="main-content">
            <h3>Profile</h3>
            <p>Lulusan SMK jurusan Rekayasa Perangkat Lunak yang berdedikasi dengan kombinasi keterampilan di bidang Teknologi Informasi, Pengembangan Perangkat Lunak, Desain Grafis, dan Bisnis Digital. Memiliki pengalaman kepemimpinan yang solid selama dua periode di OSIS SMK sebagai Ketua Ekstrakurikuler Robotika dan Ketua Ekstrakurikuler Paskibraka, serta terpilih sebagai Paskibraka Kabupaten Ponorogo tahun 2025. Selain itu, aktif berkontribusi dalam tim Multimedia Sekolah yang mengasah kemampuan teknis saya dalam dasar pemrograman, pembuatan website, pengelolaan database, serta desain grafis. Saya adalah individu yang disiplin, mudah beradaptasi, cepat menguasai hal baru, dan siap berkontribusi dalam tim.</p>

            <div class="pengalaman">
                <h3>Pengalaman Kerja</h3>
                
                <div class="pengalaman-item">
                    <h4>Junior Web Developer & Graphic Designer (Magang)</h4>
                    <div class="perusahaan">PT. Vexa Digital Solutions</div>
                    <div class="tanggal">April 2026 - September 2026</div>
                    <ul>
                        <li><strong>Web E-Commerce:</strong> Merancang dan membangun website toko online responsif, integrasi katalog produk, dan optimasi antarmuka.</li>
                        <li><strong>Sistem Absensi:</strong> Membangun Sistem Absensi Sekolah Online Berbasis Barcode secara mandiri untuk proses absensi real-time.</li>
                        <li><strong>Database & Coding:</strong> Merancang struktur database dan menulis kode efisien untuk stabilitas aplikasi web.</li>
                        <li><strong>Desain Grafis:</strong> Menciptakan aset visual dan desain komersial untuk kebutuhan pemasaran digital marketplace akun game.</li>
                    </ul>
                </div>
            </div>

            <!-- Web Dinamis Toko Merch Band Lokal Skena Mentok -->
            <div class="btn-usaha-container">
               <a href="/login" class="btn-usaha">Masuk ke Sistem Toko</a>
            </div>
        </div>
    </div>

</body>
</html>