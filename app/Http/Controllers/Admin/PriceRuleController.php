<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PriceRule;
use Illuminate\Http\Request;

class PriceRuleController extends Controller
{
    public function index()
    {
        $priceRules = PriceRule::orderByDesc('id')->paginate(10);
        return view('admin.price_rules.index', compact('priceRules'));
    }

    public function create()
    {
        return view('admin.price_rules.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
        ]);
        PriceRule::create($data);
        return redirect()->route('admin.price_rules.index')->with('success', 'Thêm quy tắc giá thành công');
    }

    public function edit(PriceRule $priceRule)
    {
        return view('admin.price_rules.edit', compact('priceRule'));
    }

    public function update(Request $request, PriceRule $priceRule)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
        ]);
        $priceRule->update($data);
        return redirect()->route('admin.price_rules.index')->with('success', 'Cập nhật quy tắc giá thành công');
    }

    public function destroy(PriceRule $priceRule)
    {
        $priceRule->delete();
        return redirect()->route('admin.price_rules.index')->with('success', 'Xóa quy tắc giá thành công');
    }
}
