@extends('layout.admin.AdminLayout')

@section('content-main')
<h3>Quản lý đặt vé</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif



<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Chuyến</th>
            <th>Điểm đón</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th width="180">Hành động</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookings as $b)
        <tr>
            <td>{{ $b->id }}</td>
            <td>{{ $b->user->name }}</td>
            <td>{{ $b->trip->id }}</td>
            <td>{{ $b->pickupPoint->name ?? '' }}</td>
            <td>{{ $b->total_amount }}</td>
            <td>
                <span class="badge bg-{{ $b->status == 'paid' ? 'success' : ($b->status == 'pending' ? 'warning' : 'danger') }}">
                    {{ $b->status }}
                </span>
            </td>
            <td>
                

                @if($b->status !== 'paid')
                <form action="{{ route('bookings.destroy',$b->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection