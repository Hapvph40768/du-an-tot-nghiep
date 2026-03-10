@extends('layout.admin.AdminLayout')

@section('content-main')

<div class="container mt-5">

    <div class="card border-0 shadow-lg rounded-4">

        {{-- Header --}}
        <div class="card-header bg-gradient bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-bus-front"></i> Danh sách Trips
            </h4>

            <a href="{{ route('admin.trips.create') }}"
                class="btn btn-light fw-semibold">
                <i class="bi bi-plus-circle"></i> Thêm
            </a>
        </div>

        <div class="card-body p-4">

            {{-- Thông báo --}}
            @if(session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">

                <div class="table-responsive">

                    <table class="table custom-table align-middle text-center mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tuyến</th>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Giá vé</th>
                                <th>Xe</th>
                                <th>Tài xế</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($trips as $trip)
                            <tr>

                                <td class="fw-bold text-primary">
                                    #{{ $trip->id }}
                                </td>

                                <td class="text-start">
                                    {{ $trip->route->startLocation->name ?? '' }}
                                    →
                                    {{ $trip->route->endLocation->name ?? '' }}
                                </td>

                                <td>
                                    <span class="badge badge-date">
                                        {{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge badge-time">
                                        {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}
                                    </span>
                                </td>

                                <td class="price-text">
                                    {{ number_format($trip->price) }} VNĐ
                                </td>

                                <td>{{ $trip->vehicle->name ?? '' }}</td>

                                <td>{{ $trip->driver->name ?? '' }}</td>

                                <td>
                                    <a href="{{ route('admin.trips.edit', $trip->id) }}"
                                        class="btn btn-sm btn-warning text-white">
                                        ✏ Sửa
                                    </a>

                                    <form action="{{ route('admin.trips.destroy', $trip->id) }}"
                                        method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                                            🗑 Xóa
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="py-4 text-muted">
                                    Không có dữ liệu
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Phân trang --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $trips->links() }}
            </div>

        </div>
    </div>

</div>

@endsection