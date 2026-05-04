@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">{{{ __('notifications') }} hệ thống</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>Thời gian</th>
                        <th>Loại</th>
                        <th>Nội dung</th>
                        <th>Đã đọc</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notif)
                    <tr>
                        <td><small class="text-muted">{{ $notif->created_at->format('d/m/Y H:i') }}}</small></td>
                        <td><span class="badge bg-secondary small">{{ class_basename($notif->type) }}}</span></td>
                        <td class="small">{{ json_encode($notif->data, JSON_UNESCAPED_UNICODE) }}}</td>
                        <td>
                            @if($notif->read_at)
                                <span class="badge bg-light text-dark border">Đã đọc</span>
                            @else
                                <span class="badge bg-warning text-dark">Chưa đọc</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Không có thông báo nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $notifications->links() }}}</div>
    </div>
</div>
@endsection
