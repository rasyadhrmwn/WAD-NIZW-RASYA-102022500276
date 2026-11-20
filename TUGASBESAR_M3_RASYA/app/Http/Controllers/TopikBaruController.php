<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopikBaru;

class TopikBaruController extends Controller
{
    private function ensureCanManage()
    {
        if (!in_array(auth()->user()->role, ['dosen', 'admin'], true)) {
            abort(403, 'Hanya Dosen dan Admin yang dapat mengelola data.');
        }
    }

    // 1. READ: Menampilkan daftar data dengan limit 10 per halaman (Pagination)
    public function index()
    {
        $dataTopik = TopikBaru::paginate(10);
        return view('topik_baru.index', compact('dataTopik'));
    }

    // 2. CREATE: Form tambah data
    public function create()
    {
        $this->ensureCanManage();
        return view('topik_baru.create');
    }

    // 2. CREATE: Simpan data baru
    public function store(Request $request)
    {
        $this->ensureCanManage();

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
        $this->ensureCanManage();

        $topik = TopikBaru::findOrFail($id);
        return view('topik_baru.edit', compact('topik'));
    }

    // 3. UPDATE: Simpan perubahan data
    public function update(Request $request, $id)
    {
        $this->ensureCanManage();

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
        $this->ensureCanManage();

        $topik = TopikBaru::findOrFail($id);
        $topik->delete();

        return redirect('/daftar-topik')->with('success', 'Topik berhasil dihapus!');
    }
}