<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Topik Tugas Akhir</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; background-color: #f4f6f9; }
        header { background-color: #C8102E; color: white; padding: 20px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        header h2 { margin: 0; font-size: 22px; }
        header p { margin: 5px 0 0; font-size: 14px; opacity: 0.9; }
        
        .container { padding: 30px; flex: 1; max-width: 1100px; margin: 20px auto; width: 100%; box-sizing: border-box; background-color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-radius: 8px; }
        
        h1 { font-size: 24px; color: #333; margin-top: 0; margin-bottom: 20px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; background-color: white; }
        th, td { border: 1px solid #e0e0e0; padding: 12px 15px; text-align: left; font-size: 14px; vertical-align: middle; }
        
        /* Table Header Merah */
        th { background-color: #C8102E; color: white; font-weight: bold; }
        
        tr:nth-child(even) { background-color: #fcfcfc; }
        tr:hover { background-color: #f8f9fa; }

        .btn-tambah { background-color: #28a745; color: white; padding: 10px 18px; text-decoration: none; display: inline-block; margin-bottom: 15px; border-radius: 4px; font-weight: bold; font-size: 14px; }
        .btn-tambah:hover { background-color: #218838; }

        .btn-edit { background-color: #ffc107; color: #333; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold; display: inline-block; margin-right: 4px; }
        .btn-edit:hover { background-color: #e0a800; }

        .btn-hapus { background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; font-weight: bold; }
        .btn-hapus:hover { background-color: #c82333; }

        /* Styling Pagination Kustom yang Rapi */
        .pagination-container { display: flex; justify-content: space-between; align-items: center; margin-top: 25px; padding-top: 15px; border-top: 1px solid #eee; flex-wrap: wrap; gap: 15px; }
        .pagination-info { font-size: 13px; color: #666; }
        .custom-pagination { display: flex; gap: 4px; align-items: center; list-style: none; padding: 0; margin: 0; }
        .custom-pagination a, .custom-pagination span { display: flex; align-items: center; justify-content: center; padding: 6px 12px; text-decoration: none; color: #C8102E; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; min-width: 32px; height: 32px; box-sizing: border-box; }
        .custom-pagination .active { color: #fff; background-color: #C8102E; border-color: #C8102E; font-weight: bold; }
        .custom-pagination .disabled { color: #aaa; background-color: #f8f9fa; border-color: #ddd; cursor: not-allowed; }

        footer { padding: 15px; background-color: #333; color: #fff; font-size: 13px; text-align: center; margin-top: auto; line-height: 1.5; }
    </style>
</head>
<body>
    <header>
        <h2>Sistem Tugas Akhir & Skripsi</h2>
        <p>Studi Kasus 11 - Modul Topik & Bidang Minat</p>
    </header>

    <div class="container">
        <h1>Daftar Topik Tugas Akhir & Skripsi</h1>

        @if(session('success'))
            <div style="padding: 12px; background-color: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <a href="/daftar-topik/create" class="btn-tambah">+ Tambah Topik Baru</a>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">Kode</th>
                    <th style="width: 25%;">Nama Topik</th>
                    <th style="width: 18%;">Rumpun Ilmu</th>
                    <th style="width: 25%;">Deskripsi Fokus</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataTopik as $index => $item)
                <tr>
                    <td>{{ $dataTopik->firstItem() + $index }}</td>
                    <td><strong>{{ $item->kode }}</strong></td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->rumpun }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td style="text-align: center;">
                        <a href="/daftar-topik/{{ $item->id }}/edit" class="btn-edit">Edit</a>
                        
                        <form action="/daftar-topik/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: #666;">Belum ada data topik tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Navigasi Halaman Kustom (Tanpa SVG Raksasa) -->
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan data ke-{{ $dataTopik->firstItem() ?? 0 }} dari total {{ $dataTopik->total() }} data
            </div>
            
            <div class="custom-pagination">
                {{-- Tombol Previous --}}
                @if ($dataTopik->onFirstPage())
                    <span class="disabled">&laquo; Prev</span>
                @else
                    <a href="{{ $dataTopik->previousPageUrl() }}">&laquo; Prev</a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($dataTopik->getUrlRange(1, $dataTopik->lastPage()) as $page => $url)
                    @if ($page == $dataTopik->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($dataTopik->hasMorePages())
                    <a href="{{ $dataTopik->nextPageUrl() }}">Next &raquo;</a>
                @else
                    <span class="disabled">Next &raquo;</span>
                @endif
            </div>
        </div>
    </div>

    <footer>
        <strong>Identitas Mahasiswa</strong><br>
        Nama: Mohamad Rasya Dharmawan | NIM: 102022500276 | Kelas: SI4907 | Kelompok: 11<br>
        Modul Topik & Bidang Minat
    </footer>
</body>
</html>