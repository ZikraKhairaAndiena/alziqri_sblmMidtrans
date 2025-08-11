<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $kehadirans = Kehadiran::with('siswa')->latest()->get();
        // return view('admin.kehadiran.index', compact('kehadirans'));

        $user = Auth::user();

        if ($user->role === 'orang_tua') {
            // Hanya tampilkan kehadiran anaknya
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            }
            $kehadirans = Kehadiran::where('siswa_id', $siswa->id)->orderByDesc('tanggal')->get();
            return view('admin.kehadiran.ortu', compact('kehadirans', 'siswa'));
        } else {
            // Guru bisa lihat semua tabungan
            $kehadirans = Kehadiran::with('siswa')->orderByDesc('tanggal')->paginate(10);
            $siswas = Siswa::all();
            return view('admin.kehadiran.index', compact('kehadirans', 'siswas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'guru') { // ✅
            abort(403);
        }

        $siswas = Siswa::all();
        return view('admin.kehadiran.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'guru') { // ✅
            abort(403);
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Kehadiran::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.kehadiran.index')->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        return view('admin.kehadiran.show', compact('kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        $siswas = Siswa::all();
        return view('admin.kehadiran.edit', compact('kehadiran', 'siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
         $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $kehadiran->update($request->all());

        return redirect()->route('admin.kehadiran.index')->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        return redirect()->route('admin.kehadiran.index')->with('success', 'Data kehadiran berhasil dihapus.');
    }
}
