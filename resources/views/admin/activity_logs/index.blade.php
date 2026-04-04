@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Lịch sử Hành động (Activity Log)</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>Thời gian</th>
                        <th>Người dùng</th>
                        <th>Hành động</th>
                        <th>Mô tả</th>
                        <th>Địa chỉ IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td><small class="text-muted">{{ $log->created_at->format('d/m/Y H:i') }}</small></td>
                        <td>
                            @if($log->user)
                                <div class="fw-bold">{{ $log->user->name }}</div>
                                <small class="text-muted">{{ $log->user->email }}</small>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td><span class="badge bg-dark">{{ $log->action }}</span></td>
                        <td class="text-muted small">{{ $log->description ?? '—' }}</td>
                        <td><small>{{ $log->ip_address ?? '—' }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Chưa có log nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
