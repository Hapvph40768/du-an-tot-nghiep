@extends('layout.admin.AdminLayout')

@section('title', 'Cập nhật Địa điểm')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h3 class="fw-bold text-dark mb-4">Chỉnh sửa Địa điểm</h3>

                    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">{{ __('name') }} địa điểm / Bến xe</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $location->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2"
                                style="background-color: #ff6b00; border:none; border-radius: 10px;">{{ __('update') }}</button>
                            <a href="{{ route('admin.locations.index') }}" class="btn btn-light px-4 py-2"
                                style="border-radius: 10px;">{{ __('cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
