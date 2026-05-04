@extends('layout.admin.AdminLayout')
@section('content-main')

<div class="top-header">
    <div class="header-title">
        <h1>{{{ __('edit') }} Đánh giá</h1>
        <p>Chỉnh sửa đánh giá #{{ $review->id }}}</p>
    </div>
    <div></div>
</div>

@if ($errors->any())
    <div style="background:#fff1f0;border:1px solid #ffa39e;padding:12px 16px;border-radius:8px;margin-bottom:20px;color:#c0392b;">
        <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
        @csrf @method('PUT')

        <div style="margin-bottom:12px;">
            <label>{{{ __('users') }}</label>
            <select name="user_id" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn người dùng --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $review->user_id ? 'selected' : '' }}>{{ $user->name }}} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Booking</label>
            <select name="booking_id" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn booking --</option>
                @foreach($bookings as $b)
                    <option value="{{ $b->id }}" {{ $b->id == $review->booking_id ? 'selected' : '' }}>#{{ $b->id }}} - User {{ $b->user_id }}}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Trip</label>
            <select name="trip_id" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn trip --</option>
                @foreach($trips as $t)
                    <option value="{{ $t->id }}" {{ $t->id == $review->trip_id ? 'selected' : '' }}>#{{ $t->id }}} - {{ $t->departure_time ?? '' }}}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Rating</label>
            <select name="rating" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">
                <option value="">-- Chọn rating --</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}" {{ $i == $review->rating ? 'selected' : '' }}>{{ $i }}}</option>
                @endfor
            </select>
        </div>

        <div style="margin-bottom:12px;">
            <label>Comment</label>
            <textarea name="comment" rows="4" style="width:100%;padding:8px;border-radius:6px;border:1px solid #e6e6e6;">{{ $review->comment }}}</textarea>
        </div>

        <div style="display:flex;gap:8px;">
            <button type="submit" style="background:#ff5b24;color:#fff;padding:10px 16px;border-radius:8px;border:none;">{{{ __('save') }}</button>
            <a href="{{ route('admin.reviews.index') }}" style="background:#f0f0f0;padding:10px 16px;border-radius:8px;text-decoration:none;color:#333;">{{{ __('cancel') }}</a>
        </div>
    </form>
</div>

@endsection
