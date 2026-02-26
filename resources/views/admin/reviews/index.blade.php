@extends('layout.admin.AdminLayout')
@section('content-main')

<div class="top-header">
    <div class="header-title">
        <h1>Quản lý Đánh giá</h1>
        <p>Danh sách đánh giá từ khách hàng</p>
    </div>
    <div style="display: flex; gap: 12px;">
        <a href="{{ route('admin.reviews.create') }}" style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">+ Tạo đánh giá</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div style="background-color: #f6ffed; border: 1px solid #b7eb8f; color: #52c41a; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ $message }}
    </div>
@endif

<div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
        <thead>
            <tr style="border-bottom: 2px solid #f0f2f5;">
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">ID</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Người dùng</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Booking</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Trip</th>
                <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Rating</th>
                <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr style="border-bottom: 1px solid #f0f2f5;">
                    <td style="padding: 16px;">{{ $review->id }}</td>
                    <td style="padding: 16px;">{{ $review->user->name ?? ('#' . $review->user_id) }}</td>
                    <td style="padding: 16px;">{{ $review->booking_id }}</td>
                    <td style="padding: 16px;">{{ $review->trip_id }}</td>
                    <td style="padding: 16px;">{{ $review->rating }} / 5</td>
                    <td style="padding: 16px; text-align: center;">
                        <a href="{{ route('admin.reviews.show', $review->id) }}" style="display: inline-block; background-color: #e6f7ff; color: #1890ff; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin-right: 6px;">Xem</a>
                        <a href="{{ route('admin.reviews.edit', $review->id) }}" style="display: inline-block; background-color: #fff7e6; color: #ff7a45; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin-right: 6px;">Sửa</a>
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;" onclick="return confirm('Bạn chắc chứ?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 32px; text-align: center; color: #999;">Chưa có đánh giá nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $reviews->links() }}
</div>

@endsection
