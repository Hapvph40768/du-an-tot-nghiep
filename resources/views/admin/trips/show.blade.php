@extends('layout.admin')

@section('title', 'Chi tiết chuyến xe #' . $trip->id)

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --secondary-bg: #f8fafc; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; height: 100%; }
    .label-custom { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #94a3b8; letter-spacing: 0.5px; }
    .value-custom { font-size: 16px; font-weight: 700; color: #1e293b; display: block; margin-top: 4px; }
    
    /* Lộ trình dừng */
    .timeline-item { position: relative; padding-left: 30px; padding-bottom: 20px; border-left: 2px dashed #e2e8f0; }
    .timeline-item:last-child { border-left: none; padding-bottom: 0; }
    .timeline-item::before { content: ''; position: absolute; left: -7px; top: 0; width: 12px; height: 12px; background: var(--primary-color); border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #ff6b0033; }
    
    .capacity-box { background: #f1f5f9; padding: 20px; border-radius: 12px; text-align: center; }
    .capacity-number { font-size: 2.5rem; font-weight: 800; color: #ff6b00; }
    .capacity-label { font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 5px; }
    .capacity-stats { display: flex; justify-content: space-around; margin-top: 15px; border-top: 1px dashed #cbd5e1; padding-top: 15px; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <a href="{{ route('admin.trips.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> QUAY LẠI DANH SÁCH
            </a>
            <h2 class="fw-bold text-dark m-0 mt-2">
                {{ $trip->route->departureLocation->name }} 
                <i class='bx bx-right-arrow-alt text-primary'></i> 
                {{ $trip->route->destinationLocation->name }}
            </h2>
            <div class="mt-1">
                <span class="badge bg-primary rounded-pill">Mã chuyến: #TRIP-{{ $trip->id }}</span>
                <span class="badge bg-light text-dark border rounded-pill ms-1">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-light border px-4 rounded-3"><i class='bx bx-edit'></i> Chỉnh sửa thông tin</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card-box">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Vận hành & Tài chính</h5>
                <div class="row g-4">
                    <div class="col-6">
                        <span class="label-custom">Giờ xuất bến</span>
                        <span class="value-custom text-primary fs-4">{{ $trip->departure_time }}</span>
                    </div>
                    <div class="col-6">
                        <span class="label-custom">Giờ đến dự kiến</span>
                        <span class="value-custom">{{ $trip->arrival_time }}</span>
                    </div>
                    <div class="col-12">
                        <span class="label-custom">Giá vé niêm yết</span>
                        <span class="value-custom text-danger fs-5">{{ number_format($trip->price) }} VNĐ</span>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <span class="label-custom">Phương tiện</span>
                            <span class="value-custom">{{ $trip->vehicle->license_plate }} ({{ $trip->vehicle->type }})</span>
                            <hr class="my-2">
                            <span class="label-custom">Tài xế phụ trách</span>
                            <span class="value-custom">{{ $trip->driver->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h5 class="fw-bold m-0">Tình trạng đặt vé</h5>
                    <span class="badge bg-success small">Đang mở bán</span>
                </div>
                
                <div class="capacity-box text-center">
                    <div class="capacity-number">{{ $availableSeats }}</div>
                    <div class="capacity-label">Chỗ còn trống</div>
                    
                    <div class="capacity-stats">
                        <div>
                            <span class="d-block fw-bold text-dark fs-5">{{ $totalSeats }}</span>
                            <span class="text-muted small">Tổng ghế</span>
                        </div>
                        <div>
                            <span class="d-block fw-bold text-danger fs-5">{{ $bookedSeats }}</span>
                            <span class="text-muted small">Đã đặt</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('admin.tickets.index', ['trip_id' => $trip->id]) }}" class="btn btn-primary w-100 py-2 fw-bold" style="background: var(--primary-color); border-color: var(--primary-color);">
                        <i class='bx bx-list-ol mr-1'></i> Xem danh sách vé
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Lịch trình chi tiết (Timeline) -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h5 class="fw-bold m-0">Lịch trình chi tiết (Các điểm dừng)</h5>
                    <button type="button" class="btn btn-sm btn-primary fw-bold" style="background: var(--primary-color); border-color: var(--primary-color);" data-bs-toggle="modal" data-bs-target="#addStopoverModal">
                        <i class='bx bx-plus'></i> Thêm điểm dừng
                    </button>
                </div>

                @if($trip->stopovers->count() > 0)
                    <div class="ms-3 mt-4">
                        @foreach($trip->stopovers as $stopover)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $stopover->stop_name }}</h6>
                                        <div class="text-muted small">
                                            @if($stopover->arrival_time)
                                                <span class="me-3"><i class='bx bx-time-five'></i> Đến: {{ \Carbon\Carbon::parse($stopover->arrival_time)->format('H:i') }}</span>
                                            @endif
                                            @if($stopover->departure_time)
                                                <span><i class='bx bx-time'></i> Đi: {{ \Carbon\Carbon::parse($stopover->departure_time)->format('H:i') }}</span>
                                            @endif
                                        </div>
                                        @if($stopover->note)
                                            <div class="text-secondary small mt-1 fst-italic">- {{ $stopover->note }}</div>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-2 align-items-start">
                                        <span class="badge bg-light text-dark border">Thứ tự: {{ $stopover->stop_order }}</span>
                                        <button class="btn btn-sm btn-outline-secondary py-0 px-2" title="Sửa" 
                                            onclick="editStopover({{ $stopover->id }}, '{{ $stopover->stop_name }}', '{{ $stopover->arrival_time ? \Carbon\Carbon::parse($stopover->arrival_time)->format('H:i') : '' }}', '{{ $stopover->departure_time ? \Carbon\Carbon::parse($stopover->departure_time)->format('H:i') : '' }}', {{ $stopover->stop_order }}, '{{ $stopover->note }}')">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <form action="{{ route('admin.trips.stopovers.destroy', $stopover->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa điểm dừng này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" title="Xóa">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class='bx bx-map-alt fs-1 mb-2 text-light'></i>
                        <p>Chưa có lịch trình chi tiết nào cho chuyến đi này.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm Điểm Dừng -->
<div class="modal fade" id="addStopoverModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.trips.stopovers.store', $trip->id) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Thêm Điểm Dừng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Tên địa điểm <span class="text-danger">*</span></label>
                    <input type="text" name="stop_name" class="form-control" required placeholder="VD: Trạm dừng chân A">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-bold">Giờ đến</label>
                        <input type="time" name="arrival_time" class="form-control">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-bold">Giờ đi</label>
                        <input type="time" name="departure_time" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Thứ tự <span class="text-danger">*</span></label>
                    <input type="number" name="stop_order" class="form-control" required min="1" value="{{ $trip->stopovers->count() + 1 }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Ghi chú</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="Ghi chú thêm..."></textarea>
                </div>
            </div>
            <div class="modal-footer flex-nowrap p-0">
                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end text-muted" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 text-primary fw-bold">Thêm mới</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Sửa Điểm Dừng -->
<div class="modal fade" id="editStopoverModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editStopoverForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Chỉnh Sửa Điểm Dừng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Tên địa điểm <span class="text-danger">*</span></label>
                    <input type="text" name="stop_name" id="edit_stop_name" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-bold">Giờ đến</label>
                        <input type="time" name="arrival_time" id="edit_arrival_time" class="form-control">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-bold">Giờ đi</label>
                        <input type="time" name="departure_time" id="edit_departure_time" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Thứ tự <span class="text-danger">*</span></label>
                    <input type="number" name="stop_order" id="edit_stop_order" class="form-control" required min="1">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Ghi chú</label>
                    <textarea name="note" id="edit_note" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer flex-nowrap p-0">
                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end text-muted" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 text-primary fw-bold">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editStopover(id, name, arrival, departure, order, note) {
        document.getElementById('editStopoverForm').action = '/admin/trips/stopovers/' + id;
        document.getElementById('edit_stop_name').value = name;
        document.getElementById('edit_arrival_time').value = arrival;
        document.getElementById('edit_departure_time').value = departure;
        document.getElementById('edit_stop_order').value = order;
        document.getElementById('edit_note').value = note;
        
        var editModal = new bootstrap.Modal(document.getElementById('editStopoverModal'));
        editModal.show();
    }
</script>

