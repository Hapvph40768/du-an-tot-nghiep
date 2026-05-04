@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Quản lý Hỗ trợ Khách hàng</h1>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Mã</th>
                                <th>Khách hàng</th>
                                <th>Loại</th>
                                <th>{{{ __('description') }}</th>
                                <th>{{{ __('status') }}</th>
                                <th>{{{ __('date') }} gửi</th>
                                <th class="text-end pe-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td class="ps-4">#{{ $ticket->id }}}</td>
                                    <td>
                                        <div class="fw-bold">{{ $ticket->user->name ?? 'N/A' }}}</div>
                                        <small class="text-muted">{{ $ticket->user->phone ?? '' }}}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info px-2">
                                            {{ ucfirst($ticket->type) }}}</span>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;">{{ $ticket->description }}}</div>
                                    </td>
                                    <td>
                                        @if ($ticket->status == 'open')
                                            <span class="badge bg-danger rounded-pill">Chưa xử lý</span>
                                        @elseif($ticket->status == 'processing')
                                            <span class="badge bg-warning text-dark rounded-pill">Đang phản hồi</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill">Đã đóng</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->created_at->format('H:i d/m/Y') }}}</td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.support_tickets.show', $ticket->id) }}"
                                            class="btn btn-sm btn-primary px-3">
                                            <i class='bx bx-message-detail'></i> Trả lời
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">Không có yêu cầu hỗ trợ nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $tickets->links() }}}</div>
    </div>
@endsection
