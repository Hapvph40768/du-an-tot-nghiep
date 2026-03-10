@extends('layout.admin.AdminLayout')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm tài xế mới</h4>
        </div>

        <div class="card-body">

            {{-- Hiển thị lỗi validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Có lỗi xảy ra:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- Tên tài xế --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tên tài xế</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ old('name') }}"
                            required
                        >
                    </div>

                    {{-- Số điện thoại --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input 
                            type="text" 
                            name="phone" 
                            class="form-control" 
                            value="{{ old('phone') }}"
                            required
                        >
                    </div>

                    {{-- Số bằng lái --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số bằng lái</label>
                        <input 
                            type="text" 
                            name="license_number" 
                            class="form-control" 
                            value="{{ old('license_number') }}"
                            required
                        >
                    </div>

                    {{-- Kinh nghiệm --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số năm kinh nghiệm</label>
                        <input 
                            type="number" 
                            name="experience_years" 
                            class="form-control" 
                            value="{{ old('experience_years') }}"
                            min="0"
                        >
                    </div>

                    {{-- Trạng thái --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Active</option>
                            <option value="busy" {{ old('status')=='busy' ? 'selected' : '' }}>Busy</option>
                            <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Ảnh tài xế --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh tài xế</label>
                        <input 
                            type="file" 
                            name="image" 
                            class="form-control"
                        >
                    </div>

                    {{-- Thông tin cá nhân --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Thông tin cá nhân</label>
                        <textarea 
                            name="personal_info" 
                            rows="4" 
                            class="form-control"
                        >{{ old('personal_info') }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
                        Quay lại danh sách
                    </a>

                    <button type="submit" class="btn btn-success">
                        Thêm tài xế
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection