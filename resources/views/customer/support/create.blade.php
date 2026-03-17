@extends('customer.home')

@section('content-main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 text-center">Gửi yêu cầu hỗ trợ</h3>
                    
                    <form action="{{ route('customer.support.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Loại yêu cầu <span class="text-danger">*</span></label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror">
                                <option value="ticket">Vấn đề về Vé xe</option>
                                <option value="payment">Vấn đề về Thanh toán</option>
                                <option value="complaint">Khiếu nại dịch vụ</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã đặt vé (nếu có)</label>
                            <input type="number" name="booking_id" class="form-control @error('booking_id') is-invalid @enderror" placeholder="Ví dụ: 12345">
                            @error('booking_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nội dung chi tiết <span class="text-danger">*</span></label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Vui lòng mô tả vấn đề bạn gặp phải..."></textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Gửi yêu cầu</button>
                            <a href="{{ route('customer.support.index') }}" class="btn btn-link text-muted">Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection