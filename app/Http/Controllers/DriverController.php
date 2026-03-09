<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    // 1. Hiển thị danh sách
    public function index(Request $request)
{
    // 1. Khởi tạo Query
    $query = Driver::query();

    // 2. Lọc theo Từ khóa (Tên, SĐT, Bằng lái)
    if ($request->has('keyword') && $request->keyword != '') {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('phone', 'like', '%' . $keyword . '%')
              ->orWhere('license_number', 'like', '%' . $keyword . '%');
        });
    }

    // 3. Lọc theo Trạng thái (Active, Busy, Inactive)
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    // 4. Phân trang & Giữ lại tham số tìm kiếm khi chuyển trang
    $drivers = $query->latest()->paginate(10)->withQueryString();

    return view('admin.drivers.index', compact('drivers'));
}

    // 2. Hiển thị form thêm mới
    public function create()
    {
        return view('admin.drivers.create');
    }

    // 3. Lưu dữ liệu thêm mới
    public function store(Request $request)
{
    // 1. Validate dữ liệu trước
    $request->validate([
        'name' => 'required|max:255',
        // Dòng dưới quan trọng: unique:drivers,phone nghĩa là kiểm tra bảng drivers cột phone xem trùng chưa
        'phone' => 'required|unique:drivers,phone', 
        'license_number' => 'required',
        'status' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        // Tùy chỉnh thông báo lỗi tiếng Việt
        'phone.unique' => 'Số điện thoại này đã tồn tại trên hệ thống!',
        'name.required' => 'Vui lòng nhập tên tài xế.',
        'phone.required' => 'Vui lòng nhập số điện thoại.',
    ]);

    // 2. Nếu qua được bước trên thì mới chạy code lưu
    $data = $request->all();

    // Xử lý ảnh (giữ nguyên code cũ của bạn)
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/drivers'), $filename);
        $data['image'] = 'uploads/drivers/' . $filename;
    }

    // 3. Tạo mới
    Driver::create($data);

    return redirect()->route('drivers.index')->with('success', 'Thêm tài xế thành công!');
}

    // 4. Hiển thị form sửa (Kiêm xem chi tiết)
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.drivers.edit', compact('driver'));
    }

    // 5. Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
            'license_number' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Xử lý ảnh mới nếu có upload
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($driver->image && file_exists(public_path($driver->image))) {
                unlink(public_path($driver->image));
            }

            // Lưu ảnh mới
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('drivers', $fileName, 'public');
            $data['image'] = 'storage/' . $filePath;
        }

        $driver->update($data);

        return redirect()->route('drivers.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // 6. Xóa tài xế
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);

        // Xóa ảnh khỏi server cho sạch
        if ($driver->image && file_exists(public_path($driver->image))) {
            unlink(public_path($driver->image));
        }

        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Đã xóa tài xế khỏi hệ thống.');
    }
}