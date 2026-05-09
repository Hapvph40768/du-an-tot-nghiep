@extends('layout.driver.DriverLayout')

@section('page-title', 'Cập nhật thông tin bổ sung')

@section('content-main')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ __('update') }} hồ sơ tài xế</h2>
            
            @if(session('warning'))
                <div class="bg-amber-100 text-amber-800 p-4 rounded-xl mb-6">
                    {{ session('warning') }}</div>
            @endif

            <form action="{{ route('driver.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Số điện thoại <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->driver?->phone ?? Auth::user()->phone) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Số bằng lái <span class="text-red-500">*</span></label>
                        <input type="text" name="license_number" value="{{ old('license_number', Auth::user()->driver?->license_number) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                        @error('license_number') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Số năm kinh nghiệm <span class="text-red-500">*</span></label>
                        <input type="number" name="experience_years" value="{{ old('experience_years', Auth::user()->driver?->experience_years) }}" min="0" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500" required>
                        @error('experience_years') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium text-gray-700">Thông tin cá nhân (Tuỳ chọn)</label>
                    <textarea name="personal_info" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('personal_info', Auth::user()->driver?->personal_info) }}</textarea>
                    @error('personal_info') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('driver.profile') }}" class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition">{{ __('cancel') }} / Bỏ qua</a>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-amber-600 text-white font-medium hover:bg-amber-700 transition">{{ __('update') }} thông tin</button>
                </div>
            </form>
        </div>
    </div>
@endsection
