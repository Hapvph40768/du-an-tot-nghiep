<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'booking_code' => 'nullable|string|max:255', // Liên kết với mã Booking nếu có
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'status' => 'required|string|max:255', // VD: 'issued', 'draft'
        ]);

        // Tự động sinh mã hóa đơn duy nhất
        $validated['invoice_code'] = 'INV-' . strtoupper(Str::random(10));

        Invoice::create($validated);

        return redirect()->route('admin.invoices.index')->with('success', 'Xuất hóa đơn thành công!');
    }

    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    // Hóa đơn thường không được sửa thông tin tiền bạc sau khi xuất, chỉ cập nhật trạng thái
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $invoice->update($validated);
        return back()->with('success', 'Cập nhật trạng thái hóa đơn thành công.');
    }
}