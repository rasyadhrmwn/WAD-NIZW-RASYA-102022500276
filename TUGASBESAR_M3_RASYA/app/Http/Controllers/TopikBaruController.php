<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopikBaru;

class TopikBaruController extends Controller
{
    // 1. READ: Menampilkan daftar data dengan limit 10 per halaman (Pagination)
    public function index()
    {
        $dataTopik = TopikBaru::paginate(10);
        return view('topik_baru.index', compact('dataTopik'));
    }

    // 2. CREATE: Form tambah data
    public function create()
    {
        return view('topik_baru.create');
    }

    // 2. CREATE: Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'rumpun' => 'required',
            'deskripsi' => 'required',
        ]);

        TopikBaru::create($request->all());

        return redirect('/daftar-topik')->with('success', 'Topik berhasil ditambahkan!');
    }

    // 3. UPDATE: Form edit data
    public function edit($id)
    {
        $topik = TopikBaru::findOrFail($id);
        return view('topik_baru.edit', compact('topik'));
    }

    // 3. UPDATE: Simpan perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'rumpun' => 'required',
            'deskripsi' => 'required',
        ]);

        $topik = TopikBaru::findOrFail($id);
        $topik->update($request->all());

        return redirect('/daftar-topik')->with('success', 'Topik berhasil diperbarui!');
    }

    // 4. DELETE: Hapus data
    public function destroy($id)
    {
        $topik = TopikBaru::findOrFail($id);
        $topik->delete();

        return redirect('/daftar-topik')->with('success', 'Topik berhasil dihapus!');
    }
}