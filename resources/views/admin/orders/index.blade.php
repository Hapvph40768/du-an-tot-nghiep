@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Đơn hàng')
@section('header-title', 'QUẢN LÝ ĐƠN HÀNG')
@section('header-subtitle', 'Theo dõi và xử lý đặt vé')

@section('content-main')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <form action="{{ route('orders.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class='bx bx-search'></i></span>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Tìm theo mã đơn, tên, SĐT...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <button type="submit" class="btn btn-primary w-100">{{ __('filter') }} Dữ Liệu</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3">Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>{{ __('trips') }}</th>
                        <th>{{ __('seats') }}</th>
                        <th>{{ __('total') }} tiền</th>
                        <th>{{ __('date') }} đặt</th>
                        <th>{{ __('status') }}</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-3 fw-bold text-primary">{{ $order->order_code }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->user ? $order->user->name : 'Khách vãng lai' }}</div>
                            <small class="text-muted">{{ $order->user ? $order->user->phone : '' }}</small>
                        </td>
                        <td><span class="text-muted">Đang cập nhật...</span></td>
                        <td><span class="text-muted">...</span></td>
                        
                        <td class="fw-bold text-danger">{{ number_format($order->amount, 0, ',', '.') }} đ</td>
                        <td>
                            <div>{{ $order->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                            @elseif($order->status == 'paid')
                                <span class="badge bg-info text-dark">Đã thanh toán</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Hoàn thành</span>
                            @else
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary mx-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $order->id }}" title="Chỉnh sửa">
                                <i class='bx bx-edit'></i> Sửa
                            </button>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="="{{ __('delete') }}">
                                    <i class='bx bx-trash'></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editModalLabel{{ $order->id }}">Cập nhật Đơn hàng: {{ $order->order_code }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">{{ __('total') }} tiền (VNĐ)</label>
                                                <input type="number" name="amount" class="form-control" value="{{ $order->amount }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold">{{ __('status') }}</label>
                                                <select name="status" class="form-select">
                                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('save') }} Thay Đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Không tìm thấy đơn hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            {{ $orders->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection