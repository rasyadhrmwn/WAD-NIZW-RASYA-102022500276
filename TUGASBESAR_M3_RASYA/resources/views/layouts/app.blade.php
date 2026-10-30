<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tugas Akhir & Skripsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        /* Header Merah */
        .header-top {
            background-color: #C8102E;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header-top h1 { margin: 0; font-size: 24px; }
        .header-top p { margin: 5px 0 0; font-size: 14px; }
        
        .nav-menu {
            background-color: #a00d25;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
        }
        .nav-links a:hover { text-decoration: underline; }

        /* Auth styling pada Navbar */
        .auth-section {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
        }
        .user-name {
            font-size: 14px;
            font-weight: bold;
        }
        .btn-logout {
            background-color: #ffffff;
            color: #a00d25;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.2s;
        }
        .btn-logout:hover {
            background-color: #f0f0f0;
        }

        /* Konten Utama */
        .content {
            flex: 1;
            max-width: 1200px;
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }

        /* Footer Merah */
        footer {
            background-color: #C8102E;
            color: white;
            text-align: center;
            padding: 25px 20px;
            margin-top: auto;
        }
        footer h3 { margin: 0 0 10px 0; font-size: 16px; font-weight: bold; }
        footer p { margin: 4px 0; font-size: 14px; }
    </style>
</head>
<body>

    <!-- Header & Navigasi Global -->
    <div class="header-top">
        <h1>Sistem Tugas Akhir & Skripsi</h1>
        <p>Studi Kasus 11 - Modul Topik & Bidang Minat</p>
    </div>

    <div class="nav-menu">
        <div class="nav-links">
            <a href="/daftar-topik">Topik & Bidang Minat</a>
            @auth
                <a href="/daftar-topik/create">Tambah Topik</a>
            @endauth
        </div>

        <!-- Bagian Status Auth -->
        <div class="auth-section">
            @auth
                <!-- Tampil Jika Sudah Login -->
                <span class="user-name">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @else
                <!-- Tampil Jika Belum Login -->
                <div class="nav-links">
                    <a href="{{ route('login') }}">Login</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Area Konten Dinamis -->
    <div class="content">
        @yield('konten')
    </div>

    <!-- Footer Identitas Mahasiswa (Tampil di Semua Halaman) -->
    <footer>
        <h3>Identitas Mahasiswa</h3>
        <p>Nama: Mohamad Rasya Dharmawan</p>
        <p>NIM: 102022500276</p>
        <p>Kelas: SI4907</p>
        <p>Kelompok: 11</p>
        <p style="margin-top: 10px; font-size: 12px;">Modul Topik & Bidang Minat</p>
    </footer>

</body>
</html>