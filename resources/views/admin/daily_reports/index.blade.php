@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Báo cáo Doanh thu hàng ngày</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>{{{ __('date') }}</th>
                        <th>Số đặt vé</th>
                        <th>Số vé xuất</th>
                        <th>{{{ __('total') }} doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td><i class='bx bx-calendar'></i> {{ \Carbon\Carbon::parse($report->report_date)->format('d/m/Y') }}}</td>
                        <td><span class="badge bg-primary">{{ number_format($report->total_bookings) }}}</span></td>
                        <td><span class="badge bg-info text-dark">{{ number_format($report->total_tickets) }}}</span></td>
                        <td><strong>{{ number_format($report->total_revenue) }}} ₫</strong></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Chưa có dữ liệu báo cáo nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $reports->links() }}}</div>
    </div>
</div>
@endsection
