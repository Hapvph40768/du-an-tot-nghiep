@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="top-header">
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.locations.create') }}"
                style="background-color: #ff5b24; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-plus" style="font-size: 16px;"></i> Thêm địa điểm
            </a>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Tên địa điểm</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Địa chỉ</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Thành phố</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Trạng thái</th>
                    <th style="padding: 16px; text-align: left; font-weight: 600; color: #666;">Ngày tạo</th>
                    <th style="padding: 16px; text-align: center; font-weight: 600; color: #666;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr style="border-bottom: 1px solid #f0f2f5;">
                        <td style="padding: 16px; font-weight: 600; color: #333;">
                            {{ $location->name }}
                        </td>
                        <td style="padding: 16px; color: #333;">
                            {{ $location->address ?? 'Chưa cập nhật' }}
                        </td>
                        <td style="padding: 16px; color: #333;">
                            {{ $location->city ?? '—' }}
                        </td>
                        <td style="padding: 16px;">
                            @if ($location->is_active)
                                <span
                                    style="background: #f6ffed; color: #52c41a; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Đang hoạt động
                                </span>
                            @else
                                <span
                                    style="background: #fff2f0; color: #cf1322; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Tạm ngưng
                                </span>
                            @endif
                        </td>
                        <td style="padding: 16px; color: #666;">
                            {{ $location->created_at ? \Carbon\Carbon::parse($location->created_at)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td style="padding: 16px; text-align: center;">
                            <a href="{{ route('admin.locations.edit', $location->id) }}"
                                style="display: inline-block; background-color: #fff7e6; color: #fa8c16; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; margin: 0 4px;">
                                Sửa
                            </a>

                            <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background-color: #fee; color: #c33; padding: 6px 12px; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa địa điểm {{ addslashes($location->name) }}?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 40px 16px; text-align: center; color: #999; font-size: 15px;">
                            <i class="bx bx-map-pin"
                                style="font-size: 32px; display: block; margin-bottom: 12px; color: #ddd;"></i>
                            Chưa có địa điểm / bến xe nào trong hệ thống
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $locations->appends(request()->query())->links() }}
    </div> --}}
@endsection
