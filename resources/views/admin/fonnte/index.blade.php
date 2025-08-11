@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Kirim Pesan WhatsApp (Fonnte)</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.fonnte.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nomor Tujuan (format 628...)</label>
                            <input type="text" name="nomor" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Pesan</label>
                            <textarea name="pesan" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="bx bx-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>

                    <hr>

                    <h2 class="card-title text-center fw-bold mb-4">Riwayat Pengiriman Pesan</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Tujuan</th>
                                        <th>Pesan</th>
                                        {{-- <th>Response</th> --}}
                                        <th>Waktu Kirim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $index => $log)
                                        <tr>
                                            <td>{{ $logs->firstItem() + $index }}</td>
                                            <td>{{ $log->nomor }}</td>
                                            <td>{{ $log->pesan }}</td>
                                            {{-- <td>
                                                <pre style="white-space: pre-wrap; word-wrap: break-word;">
                        {{ json_encode(json_decode($log->response), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                                </pre>
                                            </td> --}}
                                            <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada log pengiriman</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
