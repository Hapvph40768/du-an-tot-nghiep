@extends('layout.admin.AdminLayout')

@section('content-main')
<style>
    /* CSS dự phòng để đảm bảo hiển thị đẹp kể cả khi Tailwind lỗi */
    .seat-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; max-width: 250px; margin: 0 auto; }
    .seat-item { 
        aspect-ratio: 1/1; display: flex; flex-direction: column; align-items: center; justify-content: center;
        border: 2px solid #e3e3e0; border-radius: 8px; background: white; cursor: pointer; transition: 0.3s; position: relative;
    }
    .seat-item:hover { border-color: #000; }
    .seat-item.occupied { background: #fff2f2; border-color: #f53003; opacity: 0.6; cursor: not-allowed; }
    .seat-item.occupied::after { 
        content: 'X'; position: absolute; color: rgba(245, 48, 3, 0.2); font-size: 40px; font-weight: bold; 
    }
    .btn-delete-small {
        position: absolute; top: -5px; right: -5px; background: #000; color: #fff; 
        width: 18px; height: 18px; border-radius: 50%; font-size: 10px; border: none; z-index: 10;
    }
    .admin-card { background: white; border-radius: 12px; border: 1px solid #e3e3e0; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .btn-main { background: #f53003; color: white; padding: 10px 20px; border-radius: 4px; border: none; font-weight: bold; cursor: pointer; }
</style>

<div class="p-6">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #e3e3e0; padding-bottom: 15px;">
        <div>
            <h1 style="font-size: 20px; font-weight: bold; margin: 0;">Quản lý sơ đồ: {{ $vehicle->name }}</h1>
            <p style="font-size: 13px; color: #706f6c; margin-top: 5px;">Biển số: {{ $vehicle->license_plate }} | Loại: {{ $vehicle->type }} chỗ</p>
        </div>
        @if(!$seats->isEmpty())
            <form action="{{ route('admin.vehicles.seats.deleteAll', $vehicle->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" style="color: #f53003; text-decoration: underline; background: none; border: none; cursor: pointer; font-size: 13px;" onclick="return confirm('Xóa toàn bộ sơ đồ?')">Xóa tất cả ghế</button>
            </form>
        @endif
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        
        <div class="admin-card" style="text-align: center;">
            <div style="font-size: 11px; font-weight: bold; color: #ccc; letter-spacing: 2px; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">ĐẦU XE / TÀI XẾ</div>
            
            <div class="seat-container">
                @forelse($seats as $seat)
                    <div class="seat-item {{ $seat->status != 'Trống' ? 'occupied' : '' }}" onclick="selectSeat({{ $seat->id }} , '{{ $seat->status }}')">
                        <span style="font-weight: bold; font-size: 14px;">{{ $seat->seat_number }}</span>
                        <span style="font-size: 9px; text-transform: uppercase; color: #706f6c;">{{ $seat->type }}</span>
                        
                        <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete-small">✕</button>
                        </form>
                    </div>
                @empty
                    <div style="grid-column: span 3; padding: 40px 0; color: #ccc;">Chưa có sơ đồ ghế</div>
                @endforelse
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">
            @if($seats->isEmpty())
                <div class="admin-card" style="background: #fff2f2; border-color: #f5300322;">
                    <h3 style="color: #f53003; margin-top: 0;">Khởi tạo sơ đồ</h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.6;">Xe này chưa có ghế. Bạn có muốn tự động tạo <strong>{{ $vehicle->type }} ghế</strong> từ A01 đến A{{ $vehicle->type }} không?</p>
                    <form action="{{ route('admin.vehicles.seats.generate', $vehicle->id) }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <button type="submit" class="btn-main">Khởi tạo ngay</button>
                    </form>
                </div>
            @else
                <div class="admin-card">
                    <h3 style="margin-top: 0;">Hướng dẫn</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px; color: #555;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 15px; height: 15px; border: 1px solid #ccc; background: white;"></div>
                            <span>Ghế trống: Click vào để chọn vị trí.</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 15px; height: 15px; border: 1px solid #f53003; background: #fff2f2;"></div>
                            <span>Ghế đã chọn: Bị mờ và không thể click.</span>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <p style="font-size: 11px; color: #aaa; font-weight: bold; text-transform: uppercase; margin-bottom: 15px;">Admin: Thêm ghế đơn lẻ</p>
                    <form action="{{ route('admin.vehicles.seats.store', $vehicle->id) }}" method="POST" style="display: flex; gap: 10px;">
                        @csrf
                        <input type="text" name="seat_number" placeholder="Số ghế" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                        <select name="type" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="Thường">Thường</option>
                            <option value="VIP">VIP</option>
                        </select>
                        <input type="hidden" name="status" value="Trống">
                        <button type="submit" style="background: #000; color: #fff; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Thêm</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function selectSeat(seatId, status) {
        if(status !== 'Trống') return;
        if(!confirm('Xác nhận đặt ghế này?')) return;

        fetch(`/admin/seats/${seatId}/select`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(res => res.json()).then(data => {
            if(data.success) { alert(data.success); window.location.reload(); }
            else { alert(data.error); }
        });
    }
</script>
@endsection