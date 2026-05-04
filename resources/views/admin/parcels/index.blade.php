@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}}</div>
    @endif
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Ký gửi Hàng hoá</h3>
            <a href="{{ route('admin.parcels.create') }}" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Đơn ký gửi
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>{{{ __('sender') }}</th>
                        <th>{{{ __('receiver') }}</th>
                        <th>{{{ __('routes') }}</th>
                        <th>{{{ __('weight') }}</th>
                        <th>Phí vận chuyển</th>
                        <th>{{{ __('status') }}</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parcels as $parcel)
                    <tr>
                        <td>#{{ $parcel->id }}}</td>
                        <td>
                            <div class="fw-bold">{{ $parcel->sender_name }}}</div>
                            <small class="text-muted">{{ $parcel->sender_phone }}}</small>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $parcel->receiver_name }}}</div>
                            <small class="text-muted">{{ $parcel->receiver_phone }}}</small>
                        </td>
                        <td>{{ $parcel->route->departureLocation->name ?? '—' }}} → {{ $parcel->route->destinationLocation->name ?? '—' }}}</td>
                        <td>{{ $parcel->weight }}} kg</td>
                        <td>{{ number_format($parcel->price) }}} ₫</td>
                        <td>
                            @php
                                $statusMap = ['pending'=>['Chờ xử lý','warning'], 'shipping'=>['Đang vận chuyển','primary'], 'completed'=>['Hoàn thành','success'], 'cancelled'=>['Đã huỷ','danger']];
                                [$label, $color] = $statusMap[$parcel->status] ?? [$parcel->status, 'secondary'];
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $label }}}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.parcels.edit', $parcel->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá đơn ký gửi này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Chưa có đơn hàng ký gửi nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $parcels->links() }}}</div>
    </div>
</div>
@endsection
