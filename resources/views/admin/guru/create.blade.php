@extends('admin.layouts.main')

@section('title', 'Tambah Guru')

@section('content')
<div class="content-wrapper">
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Tambah Guru</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label fw-semibold">Akun User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Pilih Akun --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_guru" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" maxlength="15" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pend_terakhir" class="form-control" maxlength="30" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai Mengajar</label>
                <input type="date" name="tgl_mulai_ngajar" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
