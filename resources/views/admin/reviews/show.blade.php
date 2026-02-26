@extends('layout.admin.AdminLayout')
@section('content-main')

<div class="top-header">
    <div class="header-title">
        <h1>Chi tiết Đánh giá</h1>
        <p>Đánh giá #{{ $review->id }}</p>
    </div>
    <div></div>
</div>

<div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
    <p><strong>ID:</strong> {{ $review->id }}</p>
    <p><strong>Người dùng:</strong> {{ $review->user->name ?? ('#' . $review->user_id) }}</p>
    <p><strong>Booking:</strong> #{{ $review->booking_id }}</p>
    <p><strong>Trip:</strong> #{{ $review->trip_id }}</p>
    <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
    <p><strong>Comment:</strong></p>
    <div style="background:#fafafa;padding:12px;border-radius:8px;margin-top:8px;">{{ $review->comment }}</div>

    <div style="margin-top:16px;display:flex;gap:8px;">
        <a href="{{ route('admin.reviews.edit', $review->id) }}" style="background:#fff7e6;padding:10px 16px;border-radius:8px;text-decoration:none;color:#ff7a45;">Sửa</a>
        <a href="{{ route('admin.reviews.index') }}" style="background:#f0f0f0;padding:10px 16px;border-radius:8px;text-decoration:none;color:#333;">Quay lại</a>
    </div>
</div>

@endsection
