@extends('layout.admin')
@section('content-main')
<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Khuyến mãi</h3>
            <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Khuyến mãi
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>Mã</th>
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Hiệu lực</th>
                        <th>Số lần dùng</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promotions as $p)
                    <tr>
                        <td>#{{ $p->id }}</td>
                        <td><span class="badge bg-warning text-dark fw-bold">{{ $p->code }}</span></td>
                        <td>{{ $p->type == 'percent' ? 'Phần trăm (%)' : 'Cố định (VNĐ)' }}</td>
                        <td>{{ $p->type == 'percent' ? $p->value.'%' : number_format($p->value).' ₫' }}</td>
                        <td>
                            <small>{{ $p->start_date ? \Carbon\Carbon::parse($p->start_date)->format('d/m/Y') : '—' }}</small>
                            →
                            <small>{{ $p->end_date ? \Carbon\Carbon::parse($p->end_date)->format('d/m/Y') : '—' }}</small>
                        </td>
                        <td>{{ $p->current_uses }} / {{ $p->max_uses ?? '∞' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.promotions.edit', $p->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.promotions.destroy', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá khuyến mãi này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Chưa có khuyến mãi nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $promotions->links() }}</div>
    </div>
</div>
@endsection
