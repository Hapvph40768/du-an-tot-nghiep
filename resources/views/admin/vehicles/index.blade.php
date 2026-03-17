@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="top-header">
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.vehicles.create') }}"
                style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-plus" style="font-size: 16px;"></i> Thêm xe
            </a>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Phương tiện</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Loại xe / Số ghế</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Trạng thái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Ngày tạo</th>
                    <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr style="border-bottom: 1px solid #f0f2f5;">
                        <td style="padding: 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div
                                    style="width: 48px; height: 48px; border-radius: 8px; overflow: hidden; background: linear-gradient(135deg, #fff3e0, #ffe0b2); border: 1px solid #ffe8cc; flex-shrink: 0;">
                                    @if (!empty($vehicle->image) && file_exists(public_path($vehicle->image)))
                                        <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->license_plate }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div
                                            style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #ff8c00; font-weight: bold; font-size: 18px;">
                                            {{ strtoupper(substr($vehicle->license_plate ?? 'XE', 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #333;">{{ $vehicle->license_plate }}</div>
                                    <div style="color: #888; font-size: 12px;">ID: #{{ $vehicle->id }}</div>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 16px; color: #333;">
                            {{ $vehicle->type ?? 'Chưa xác định' }}
                            <div style="color: #888; font-size: 12px;">{{ $vehicle->total_seats ?? '?' }} chỗ</div>
                        </td>

                        <td style="padding: 16px;">
                            @if ($vehicle->status == 'active')
                                <span
                                    style="background: #f6ffed; color: #52c41a; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Hoạt động
                                </span>
                            @else
                                <span
                                    style="background: #fff7e6; color: #fa8c16; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Bảo dưỡng
                                </span>
                            @endif
                        </td>

                        <td style="padding: 16px; color: #666;">
                            {{ $vehicle->created_at ? $vehicle->created_at->format('d/m/Y') : 'N/A' }}
                        </td>

                        <td style="padding: 16px; text-align: center;">
                            <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                style="display: inline-block; background-color: #fff7e6; color: #fa8c16; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin: 0 4px;">
                                Sửa
                            </a>

                            <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa xe {{ addslashes($vehicle->license_plate) }}?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 40px 16px; text-align: center; color: #999; font-size: 15px;">
                            Chưa có phương tiện nào trong hệ thống
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $vehicles->appends(request()->query())->links() }}
    </div>
@endsection
