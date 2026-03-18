@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý điểm đón chuyến #' . $trip->id)

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .pickup-item { border: 1px solid #edf2f7; border-radius: 12px; padding: 12px; margin-bottom: 10px; transition: 0.3s; }
    .pickup-item:hover { border-color: var(--primary-color); background: #fffaf5; }
    .list-group-item { border: none; padding: 12px 0; border-bottom: 1px solid #f3f4f6; }
    .checkpoint-icon { color: var(--primary-color); font-size: 20px; }
    
    /* Style cho nút thêm mới mini */
    .btn-add-mini { font-size: 11px; padding: 2px 10px; border-radius: 20px; text-decoration: none; border: 1px solid #ff6b00; color: #ff6b00; font-weight: 700; transition: 0.3s; }
    .btn-add-mini:hover { background: #ff6b00; color: white; }
</style>

<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.trips.index') }}" class="text-decoration-none text-muted small fw-bold">
            <i class='bx bx-left-arrow-alt'></i> QUAY LẠI LỊCH TRÌNH
        </a>
        <h2 class="fw-bold text-dark m-0 mt-2">Thiết lập điểm đón</h2>
        <p class="text-muted">Chuyến: <span class="text-primary fw-bold">{{ $trip->route->departureLocation->name }} → {{ $trip->route->destinationLocation->name }}</span> ({{ $trip->departure_time }})</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-5">
            <div class="card-box">
                {{-- Cập nhật Header để có nút Thêm mới --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0"><i class='bx bx-list-check'></i> Chọn điểm dừng</h5>
                    <a href="{{ route('admin.trips.pickup_points.create', $trip->id) }}" class="btn-add-mini">
                        <i class='bx bx-plus'></i> Tạo điểm mới
                    </a>
                </div>

                <form action="{{ route('admin.trips.pickup_points.store_new', $trip->id) }}" method="POST">
                    @csrf
                    <div class="scroll-area" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
                        @foreach($allPickupPoints as $point)
                            <div class="pickup-item">
                                <div class="form-check custom-checkbox">
                                    <input class="form-check-input" type="checkbox" name="pickup_point_ids[]" 
                                           value="{{ $point->id }}" id="point_{{ $point->id }}"
                                           {{ $trip->pickupPoints->contains($point->id) ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="point_{{ $point->id }}">
                                        <div class="fw-bold text-dark">{{ $point->name }}</div>
                                        <div class="text-muted small">{{ $point->address }}</div>
                                        <span class="badge bg-light text-muted border mt-1" style="font-size: 10px;">
                                            {{ $point->location->name ?? 'N/A' }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2" style="background: #ff6b00; border:none; border-radius: 10px;">
                            Cập nhật lộ trình dừng
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card-box">
                <h5 class="fw-bold mb-4"><i class='bx bx-map-pin'></i> Lộ trình dừng thực tế ({{ $trip->pickupPoints->count() }})</h5>
                
                @if($trip->pickupPoints->isEmpty())
                    <div class="text-center py-5">
                        <i class='bx bx-map-alt fs-1 text-muted opacity-25'></i>
                        <p class="text-muted mt-2">Chưa có điểm đón nào được chọn cho chuyến này.</p>
                    </div>
                @else
                    <div class="list-group">
                        @foreach($trip->pickupPoints as $index => $point)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 fw-bold text-primary">{{ $index + 1 }}.</div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $point->name }}</div>
                                        <div class="small text-muted"><i class='bx bx-map'></i> {{ $point->address }}</div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.trips.pickup_points.destroy', [$trip->id, $point->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Gỡ điểm này">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4 p-3 rounded-3" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                    <small class="text-muted italic">
                        <i class='bx bx-info-circle'></i> <strong>Lưu ý:</strong> Thứ tự điểm đón sẽ hiển thị cho khách hàng khi họ thực hiện đặt vé trên website.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection