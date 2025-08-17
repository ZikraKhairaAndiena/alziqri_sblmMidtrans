@extends('admin.layouts.main')

@section('title', 'Detail Rapor')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Detail Rapor</h4>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        {{-- Data Siswa --}}
                        <table class="table table-bordered mb-4">
                            <tbody>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <td>{{ $rapor->siswa->nama_siswa ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kelompok</th>
                                    <td>{{ $rapor->siswa->kelas->nama_kelas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Ajaran</th>
                                    <td>{{ $rapor->thnAjaran->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Semester</th>
                                    <td>{{ $rapor->semester }}</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- 1. Nilai Agama --}}
                        <h5 class="fw-bold mt-4">1. Perkembangan Nilai Agama dan Budi Pekerti</h5>
                        <div class="text-center mb-3">
                            @if ($rapor->foto_agama)
                                <img src="{{ asset('img/' . $rapor->foto_agama) }}"
                                    alt="Foto Agama"
                                    class="img-thumbnail"
                                    style="max-width: 250px;">
                            @endif
                        </div>
                        <p>{{ $rapor->agama }}</p>

                        {{-- 2. Jati Diri --}}
                        <h5 class="fw-bold mt-4">2. Jati Diri</h5>
                        <div class="text-center mb-3">
                            @if ($rapor->foto_jati_diri)
                                <img src="{{ asset('img/' . $rapor->foto_jati_diri) }}"
                                    alt="Foto Jati Diri"
                                    class="img-thumbnail"
                                    style="max-width: 250px;">
                            @endif
                        </div>
                        <p>{{ $rapor->jati_diri }}</p>

                        {{-- 3. Literasi --}}
                        <h5 class="fw-bold mt-4">3. Dasar-dasar Literasi</h5>
                        <div class="text-center mb-3">
                            @if ($rapor->foto_literasi)
                                <img src="{{ asset('img/' . $rapor->foto_literasi) }}"
                                    alt="Foto Literasi"
                                    class="img-thumbnail"
                                    style="max-width: 250px;">
                            @endif
                        </div>
                        <p>{{ $rapor->literasi }}</p>

                        {{-- 4. STEAM --}}
                        <h5 class="fw-bold mt-4">4. STEAM</h5>
                        <div class="text-center mb-3">
                            @if ($rapor->foto_steam)
                                <img src="{{ asset('img/' . $rapor->foto_steam) }}"
                                    alt="Foto STEAM"
                                    class="img-thumbnail"
                                    style="max-width: 250px;">
                            @endif
                        </div>
                        <p>{{ $rapor->steam }}</p>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.rapor.index') }}" class="btn btn-secondary mt-3">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                            <a href="{{ route('admin.rapor.cetak', $rapor->id) }}" class="btn btn-warning mt-3" target="_blank">
                                <i class="bx bx-printer me-1"></i> Cetak Rapor
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
