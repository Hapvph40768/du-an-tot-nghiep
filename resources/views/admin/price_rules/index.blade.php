@extends('layout.admin')
@section('content-main')
<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quy tắc Điều chỉnh Giá vé</h3>
            <a href="{{ route('admin.price_rules.create') }}" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Quy tắc
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>{{ __('name') }} quy tắc</th>
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Áp dụng từ</th>
                        <th>Đến ngày</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($priceRules as $rule)
                    <tr>
                        <td>#{{ $rule->id }}</td>
                        <td class="fw-bold">{{ $rule->name }}</td>
                        <td>{{ $rule->type == 'percentage' ? 'Phần trăm (%)' : 'Cố định (VNĐ)' }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                +{{ $rule->type == 'percentage' ? $rule->value.'%' : number_format($rule->value).' ₫' }}</span>
                        </td>
                        <td>{{ $rule->start_date ? \Carbon\Carbon::parse($rule->start_date)->format('d/m/Y') : '—' }}</td>
                        <td>{{ $rule->end_date ? \Carbon\Carbon::parse($rule->end_date)->format('d/m/Y') : '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.price_rules.edit', $rule->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.price_rules.destroy', $rule->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá quy tắc này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Chưa có quy tắc giá nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $priceRules->links() }}</div>
    </div>
</div>
@endsection
