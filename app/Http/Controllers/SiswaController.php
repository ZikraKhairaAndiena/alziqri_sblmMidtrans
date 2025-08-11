<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $siswas = Siswa::whereHas('ppdb', function ($query) {
            $query->where('status', 'Diterima');
        })->with('ppdb')->get();

        return view('admin.siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = Siswa::with('ppdb')->findOrFail($id);

        // Pastikan hanya siswa yang diterima yang bisa ditampilkan
        if ($siswa->ppdb->status !== 'Diterima') {
            abort(403, 'Siswa belum diterima');
        }

        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = Siswa::with('ppdb')->findOrFail($id);

        if ($siswa->ppdb->status !== 'Diterima') {
            abort(403, 'Siswa belum diterima');
        }

        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|in:islam,kristen,budha,hindu,kong_hu_cu',
            'suku_bangsa' => 'required|string|max:20',
            'anak_ke' => 'required|integer',
            'jmlh_saudara_kandung' => 'required|integer',
            'alamat' => 'required',
            'tmp_tinggal' => 'required|in:orang_tua,wali,nenek,saudara',
            'no_nik' => 'required|string|max:25',
            'no_kk' => 'required|string|max:25',
            'no_akte' => 'required|string|max:25',
            'nama_wali' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'status' => 'required|in:aktif,tidak_aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_akte' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['foto', 'foto_kk', 'foto_akte']);

        // Upload gambar siswa
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_siswa_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename); // Simpan gambar siswa
            // Hapus gambar lama
            if ($siswa->foto && file_exists(public_path('img/' . $siswa->foto))) {
                unlink(public_path('img/' . $siswa->foto));
            }
            $data['foto'] = $filename;
        }

        // Upload gambar KK
        if ($request->hasFile('foto_kk')) {
            $file = $request->file('foto_kk');
            $filename = time() . '_kk_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);

            // Hapus gambar KK lama
            if ($siswa->foto_kk && file_exists(public_path('img/' . $siswa->foto_kk))) {
                unlink(public_path('img/' . $siswa->foto_kk));
            }

            $data['foto_kk'] = $filename;
        }

        // Upload gambar Akte
        if ($request->hasFile('foto_akte')) {
            $file = $request->file('foto_akte');
            $filename = time() . '_akte_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);

            // Hapus gambar Akte lama
            if ($siswa->foto_akte && file_exists(public_path('img/' . $siswa->foto_akte))) {
                unlink(public_path('img/' . $siswa->foto_akte));
            }

            $data['foto_akte'] = $filename;
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
