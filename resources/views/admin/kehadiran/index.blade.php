@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Tambah Kehadiran</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.kehadiran.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Kehadiran</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ old('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="bx bx-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>

                    <hr>

                    <h2 class="card-title text-center fw-bold mb-4">Data Kehadiran</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kehadirans as $kehadiran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kehadiran->siswa->nama_siswa }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kehadiran->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $kehadiran->status }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data kehadiran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $kehadirans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
