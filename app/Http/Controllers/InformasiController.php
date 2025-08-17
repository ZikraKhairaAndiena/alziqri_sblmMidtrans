<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = Informasi::latest()->paginate(10);
        return view('admin.informasi.index', compact('informasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'type'      => 'required|in:pengumuman,info,galeri',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal'   => 'nullable|date',
        ]);

        $informasi = new Informasi($request->all());

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_informasi_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $informasi->gambar = $filename;
        }

        $informasi->save();

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('admin.informasi.show', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'type'      => 'required|in:pengumuman,info,galeri',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal'   => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($informasi->gambar && file_exists(public_path('img/' . $informasi->gambar))) {
                unlink(public_path('img/' . $informasi->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_informasi_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['gambar'] = $filename;
        }

        $informasi->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->gambar && file_exists(public_path('img/' . $informasi->gambar))) {
            unlink(public_path('img/' . $informasi->gambar));
        }

        $informasi->delete();

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
