@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ký gửi hàng hóa</h1>
            <p class="text-gray-600 mt-2">Điền thông tin gửi hàng và chọn tuyến đi. Chúng tôi sẽ xử lý yêu cầu ký gửi của bạn.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-3xl border border-gray-100 p-8">
            <form action="{{ route('customer.parcels.store') }}" method="POST">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="sender_name" class="block text-gray-700 font-medium mb-2">Người gửi</label>
                        <input type="text" name="sender_name" id="sender_name" value="{{ old('sender_name', Auth::user()->name ?? '') }}" required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm" />
                    </div>

                    <div>
                        <label for="sender_phone" class="block text-gray-700 font-medium mb-2">Số điện thoại người gửi</label>
                        <input type="text" name="sender_phone" id="sender_phone" value="{{ old('sender_phone', Auth::user()->phone ?? '') }}" required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm" />
                    </div>

                    <div>
                        <label for="receiver_name" class="block text-gray-700 font-medium mb-2">Người nhận</label>
                        <input type="text" name="receiver_name" id="receiver_name" value="{{ old('receiver_name') }}" required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm" />
                    </div>

                    <div>
                        <label for="receiver_phone" class="block text-gray-700 font-medium mb-2">Số điện thoại người nhận</label>
                        <input type="text" name="receiver_phone" id="receiver_phone" value="{{ old('receiver_phone') }}" required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm" />
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-3 mt-6">
                    <div>
                        <label for="weight" class="block text-gray-700 font-medium mb-2">Trọng lượng (kg)</label>
                        <input type="number" step="0.01" min="0" name="weight" id="weight" value="{{ old('weight') }}" required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm" />
                    </div>

                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-2">Giá ước tính (VNĐ)</label>
                        <input type="number" step="1000" min="0" name="price" id="price" value="{{ old('price') }}" required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm" />
                    </div>

                    <div>
                        <label for="route_id" class="block text-gray-700 font-medium mb-2">Chọn tuyến</label>
                        <select name="route_id" id="route_id" required
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm">
                            <option value="">-- Chọn tuyến --</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                    {{ $route->departureLocation->name ?? '...' }} → {{ $route->destinationLocation->name ?? '...' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Mô tả hàng hóa</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm">{{ old('description') }}</textarea>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-500">Tất cả yêu cầu ký gửi sẽ được xử lý bởi bộ phận vận chuyển của chúng tôi.</p>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-6 py-3 text-white font-semibold shadow-sm shadow-amber-500/20 hover:bg-amber-600 transition-colors">
                        Gửi yêu cầu ký gửi
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
