@extends('admin.layouts.main')

@section('title', 'Edit Informasi')

@section('content')
<div class="content-wrapper">
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Data Informasi</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Informasi<span class="text-danger">*</span></label>
                <input type="text" name="title" maxlength="255"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $informasi->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Informasi<span class="text-danger">*</span></label>
                <textarea name="content" rows="5"
                          class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $informasi->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Kegiatan<span class="text-danger">*</span></label>
                <input type="date" name="tanggal"
                       class="form-control @error('tanggal') is-invalid @enderror"
                       value="{{ old('tanggal', $informasi->tanggal) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Foto (opsional)</label><br>
                @if($informasi->foto)
                    <img src="{{ asset('img/' . $informasi->foto) }}" alt="Foto informasi" width="120" class="mb-2"><br>
                @endif
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
