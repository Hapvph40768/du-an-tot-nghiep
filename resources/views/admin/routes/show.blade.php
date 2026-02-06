@extends('layout.admin.AdminLayout')
@section('content-main')

<div class="top-header">
    <div class="header-title">
        <h1>Chi Tiết Tuyến Xe</h1>
        <p>Tuyến xe #{{ $route->id }}</p>
    </div>
</div>

<div style="max-width: 800px;">
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <div style="margin-bottom: 24px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div>
                    <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">ID</p>
                    <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">{{ $route->id }}</p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Trạng thái</p>
                    <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">Hoạt động</p>
                </div>
            </div>

            <div style="border-top: 1px solid #f0f2f5; padding-top: 24px; margin-bottom: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Điểm bắt đầu</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">{{ $route->startLocation->name ?? '--' }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Điểm đến</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">{{ $route->endLocation->name ?? '--' }}</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Khoảng cách</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">{{ $route->distance_km }} km</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 8px; color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase;">Thời gian dự kiến</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">{{ $route->estimated_time }} phút</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px;">
            <a href="{{ route('routes.edit', $route->id) }}" style="display: inline-block; background-color: #fff7e6; color: #ff7a45; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">Sửa</a>
            <a href="{{ route('routes.index') }}" style="display: inline-block; background-color: #f0f2f5; color: #333; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">Quay lại</a>
            <form action="{{ route('routes.destroy', $route->id) }}" method="POST" style="display: inline;">
                @csrf @method('DELETE')
                <button type="submit" style="background-color: #fee; color: #c33; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;" onclick="return confirm('Bạn chắc chứ?')">Xóa</button>
            </form>
        </div>
    </div>
</div>

@endsection