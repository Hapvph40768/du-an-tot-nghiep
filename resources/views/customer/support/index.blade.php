@extends('customer.home')

@section('content')

<div class="container py-4">

    <h3 class="mb-4">🎧 Hỗ trợ khách hàng</h3>

    <div class="row">

        {{-- FORM TẠO TICKET --}}
        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    Tạo yêu cầu hỗ trợ
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('customer.support.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Loại hỗ trợ</label>

                            <select name="type" class="form-select">
                                <option value="payment">Thanh toán</option>
                                <option value="ticket">Vé</option>
                                <option value="complaint">Khiếu nại</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>

                            <textarea 
                                name="description"
                                class="form-control"
                                rows="4"
                                placeholder="Mô tả vấn đề của bạn..."
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Gửi yêu cầu
                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- DANH SÁCH TICKET --}}
        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white">
                    Danh sách yêu cầu
                </div>

                <div class="card-body">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Ngày</th>
                                <th></th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($tickets as $ticket)

                            <tr>

                                <td>#{{ $ticket->id }}</td>

                                <td>

                                    @switch($ticket->type)

                                        @case('payment')
                                            <span class="badge bg-primary">Payment</span>
                                            @break

                                        @case('ticket')
                                            <span class="badge bg-info">Ticket</span>
                                            @break

                                        @case('complaint')
                                            <span class="badge bg-danger">Complaint</span>
                                            @break

                                    @endswitch

                                </td>

                                <td>

                                    @switch($ticket->status)

                                        @case('open')
                                            <span class="badge bg-danger">Open</span>
                                            @break

                                        @case('processing')
                                            <span class="badge bg-warning text-dark">Processing</span>
                                            @break

                                        @case('closed')
                                            <span class="badge bg-success">Closed</span>
                                            @break

                                    @endswitch

                                </td>

                                <td>
                                    {{ optional($ticket->created_at)->format('d/m/Y') }}
                                </td>

                                <td>

                                    <a href="{{ route('customer.support.show',$ticket->id) }}"
                                       class="btn btn-sm btn-dark">

                                        💬 Chat

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Chưa có ticket hỗ trợ
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection