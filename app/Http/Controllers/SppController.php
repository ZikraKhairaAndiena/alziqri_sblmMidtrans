<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'orang_tua') {
            $siswa = Siswa::where('user_id', Auth::id())->first();
            $ppdb = $siswa ? Ppdb::where('siswa_id', $siswa->id)->first() : null;

            if (!$ppdb || $ppdb->status !== 'Diterima') {
                return view('admin.pending');
            }
        }

        // Jika diterima, tampilkan halaman SPP
        return view('admin.pembayaran.index');
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
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spp $spp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spp $spp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spp $spp)
    {
        //
    }
}
