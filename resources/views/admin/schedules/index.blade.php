@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">{{ __('schedules') }} xe chạy cố định</h3>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Lịch trình
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>{{ __('routes') }}</th>
                        <th>{{ __('time') }} khởi hành</th>
                        <th>{{ __('date') }} trong tuần</th>
                        <th>{{ __('status') }}</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $s)
                    <tr>
                        <td>#{{ $s->id }}</td>
                        <td>{{ $s->route->departureLocation->name ?? '—' }} → {{ $s->route->destinationLocation->name ?? '—' }}</td>
                        <td><i class='bx bx-time'></i> {{ $s->departure_time }}</td>
                        <td>
                            @foreach($s->days_of_week as $day)
                                <span class="badge bg-light text-dark border">{{ $day }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($s->is_active)
                                <span class="badge bg-success">Đang hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Tạm ngưng</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.schedules.edit', $s->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.schedules.destroy', $s->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá lịch trình này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Chưa có lịch trình nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $schedules->links() }}</div>
    </div>
</div>
@endsection
