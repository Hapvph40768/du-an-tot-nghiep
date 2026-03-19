<<<<<<< HEAD
@extends('layout.customer.CustomerLayout')  
=======
@extends('customer.home')
>>>>>>> 330ec1f42540000c67e05d8019c14c8405ef0940

@section('content-main')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Yêu cầu hỗ trợ của tôi</h2>
        <a href="{{ route('customer.support.create') }}" class="btn btn-primary px-4 rounded-pill">
            <i class='bx bx-plus'></i> Tạo yêu cầu mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted">
                    <tr>
                        <th class="ps-4">Mã</th>
                        <th>Loại hỗ trợ</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket) {{-- BẮT BUỘC phải dùng $tickets ở đây --}}
                    <tr>
                        <td class="ps-4 text-muted">#{{ $ticket->id }}</td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary px-2">
                                {{ $ticket->type ?? 'Hỗ trợ' }}
                            </span>
                        </td>
                        <td><div class="text-truncate" style="max-width: 250px;">{{ $ticket->description }}</div></td>
                        <td>
                            <span class="badge rounded-pill {{ $ticket->status == 'open' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $ticket->status == 'open' ? 'Đang mở' : 'Đã đóng' }}
                            </span>
                        </td>
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td class="text-end pe-4">
                            <button onclick="Livewire.dispatch('selectTicket', { id: {{ $ticket->id }} })" class="btn btn-sm btn-light border">
                                <i class='bx bx-chat'></i> Chat AI
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Bạn chưa có yêu cầu nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection