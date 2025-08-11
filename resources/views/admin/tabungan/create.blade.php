@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">

    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-dark mb-0">Tambah Tabungan</h4>
        </div>

        <!-- Body -->
        <div class="card-body">

            <form action="{{ route('admin.tabungan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-2">
                    <label for="siswa_id">Nama Siswa</label>
                    <select name="siswa_id" class="form-control" required>
                        <option value="">Pilih</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label for="jenis_transaksi">Jenis Transaksi</label>
                    <select name="jenis_transaksi" class="form-control" required>
                        <option value="setor">Setor</option>
                        <option value="tarik">Tarik</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label for="bukti">Upload Bukti (opsional)</label>
                    <input type="file" name="bukti" class="form-control"  accept="image/*">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.tabungan.index') }}" class="btn btn-secondary d-flex align-items-center">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="bx bx-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
