@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Ghế ngồi')

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }} .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }} .seat-badge { background: #f3f4f6; color: #374151; padding: 6px 12px; border-radius: 8px; font-weight: 700; border: 1px solid #e5e7eb; display: inline-flex; align-items: center; gap: 5px; }} .seat-badge i { color: #9ca3af; }} .filter-section { background: #f9fafb; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #edf2f7; }}</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Danh sách Ghế ngồi</h2>
            <p class="text-muted small mb-0">Quản lý sơ đồ ghế cho từng phương tiện</p>
        </div>
        <a href="{{ route('admin.seats.create') }}" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">
            <i class='bx bx-plus'></i> Thêm ghế thủ công
        </a>
    </div>

    {{-- Bộ lọc theo xe --}}<div class="filter-section shadow-sm">
        <form action="{{ route('admin.seats.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted">{{ __('filter') }} theo Xe</label>
                <select name="vehicle_id" class="form-select rounded-3">
                    <option value="">-- Tất cả các xe --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->license_plate }} ({{ $vehicle->type }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100 rounded-3">
                    <i class='bx bx-filter-alt'></i> Lọc
                </button>
            </div>
            @if(request('vehicle_id'))
                <div class="col-md-2">
                    <a href="{{ route('admin.seats.index') }}" class="btn btn-light border w-100 rounded-3">{{ __('delete') }} lọc</a>
                </div>
            @endif
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <i class='bx bx-error-circle me-2'></i> {{ session('error') }}</div>
    @endif

    <div class="card-box">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th style="width: 10%;">ID</th>
                        <th style="width: 25%;">Mã ghế (Số ghế)</th>
                        <th style="width: 35%;">Thuộc xe (Biển số)</th>
                        <th style="width: 20%;">{{ __('created_at') }}</th>
                        <th class="text-end" style="width: 10%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seats as $seat)
                        <tr>
                            <td>#{{ $seat->id }}</td>
                            <td>
                                <div class="seat-badge">
                                    <i class='bx bx-chair'></i> {{ $seat->seat_number }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $seat->vehicle->license_plate }}</div>
                                <div class="text-muted small">{{ $seat->vehicle->type }}</div>
                            </td>
                            <td class="text-muted small">{{ $seat->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.seats.edit', $seat->id) }}" class="btn btn-sm btn-light border">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" onsubmit="return confirm('Xóa ghế này?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-light border text-danger">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Không tìm thấy ghế nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $seats->appends(request()->query())->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection