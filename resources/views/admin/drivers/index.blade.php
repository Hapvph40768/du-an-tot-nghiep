@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="top-header">
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.drivers.create') }}"
                style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-plus" style="font-size: 16px;"></i> Thêm tài xế
            </a>
        </div>
    </div>

  

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Tài xế</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Liên hệ</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Bằng lái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Trạng thái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Ngày tham gia</th>
                    <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drivers as $driver)
                    <tr style="border-bottom: 1px solid #f0f2f5;">
                        <td style="padding: 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div
                                    style="width: 48px; height: 48px; border-radius: 50%; overflow: hidden; flex-shrink: 0; background: #f0f2f5;">
                                    @if ($driver->image && file_exists(public_path($driver->image)))
                                        <img src="{{ asset($driver->image) }}" alt="{{ $driver->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($driver->name) }}&background=random&color=fff&size=128&bold=true"
                                            alt="{{ $driver->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #333;">{{ $driver->name }}</div>
                                    <div style="color: #888; font-size: 12px;">ID: #{{ $driver->id }}</div>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 16px; color: #333;">
                            <div style="font-weight: 500;">{{ $driver->phone ?? 'Chưa cập nhật' }}</div>
                            <div style="color: #888; font-size: 12px;">user{{ $driver->id }}@example.com</div>
                        </td>

                        <td style="padding: 16px;">
                            <span
                                style="background: #f0f2f5; color: #333; padding: 4px 12px; border-radius: 6px; font-size: 13px;">
                                {{ $driver->license_number ?? 'Chưa có' }}
                            </span>
                        </td>

                        <td style="padding: 16px;">
                            @if ($driver->status == 'active')
                                <span
                                    style="background: #f6ffed; color: #52c41a; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đang hoạt động
                                </span>
                            @elseif($driver->status == 'busy')
                                <span
                                    style="background: #fff7e6; color: #fa8c16; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đang chạy
                                </span>
                            @else
                                <span
                                    style="background: #f0f2f5; color: #666; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đã nghỉ
                                </span>
                            @endif
                        </td>

                        <td style="padding: 16px; color: #666;">
                            {{ $driver->created_at ? $driver->created_at->format('d/m/Y') : 'N/A' }}
                        </td>

                        <td style="padding: 16px; text-align: center;">
                            <a href="{{ route('admin.drivers.edit', $driver->id) }}"
                                style="display: inline-block; background-color: #fff7e6; color: #fa8c16; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin: 0 4px;">
                                Sửa
                            </a>

                            <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa tài xế {{ addslashes($driver->name) }}?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 40px 16px; text-align: center; color: #999; font-size: 15px;">
                            Chưa có tài xế nào trong hệ thống
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $drivers->appends(request()->query())->links() }}
    </div>
@endsection
