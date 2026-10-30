<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Topik</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background-color: #C8102E; color: white; padding: 20px; text-align: center; }
        header h2 { margin: 0; font-size: 22px; }
        header p { margin: 5px 0 0; font-size: 14px; opacity: 0.9; }
        .container { padding: 20px; flex: 1; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        textarea { height: 100px; }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        footer { padding: 15px; background-color: #f8f9fa; border-top: 1px solid #ddd; font-size: 14px; color: #555; text-align: center; margin-top: auto; }
    </style>
</head>
<body>
    <header>
        <h2>Sistem Tugas Akhir & Skripsi</h2>
        <p>Studi Kasus 11 - Modul Topik & Bidang Minat</p>
    </header>

    <div class="container">
        <h1>Edit Topik Tugas Akhir</h1>
        <form action="/daftar-topik/{{ $topik->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Kode Topik:</label>
                <input type="text" name="kode" value="{{ $topik->kode }}" required>
            </div>
            <div class="form-group">
                <label>Nama Topik:</label>
                <input type="text" name="nama" value="{{ $topik->nama }}" required>
            </div>
            <div class="form-group">
                <label>Rumpun:</label>
                <input type="text" name="rumpun" value="{{ $topik->rumpun }}" required>
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" required>{{ $topik->deskripsi }}</textarea>
            </div>
            <button type="submit">Update Data</button>
            <a href="/daftar-topik" style="margin-left: 10px; text-decoration: none; color: #555;">Batal</a>
        </form>
    </div>

    <footer>
        <strong>Identitas Mahasiswa</strong><br>
        Nama: Mohamad Rasya Dharmawan | NIM: 102022500276 | Kelas: SI4907 | Kelompok: 11<br>
        Modul Topik & Bidang Minat
    </footer>
</body>
</html>