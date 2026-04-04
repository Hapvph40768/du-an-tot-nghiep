<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function index()
    {
        $reports = DailyReport::orderByDesc('report_date')->paginate(15);
        return view('admin.daily_reports.index', compact('reports'));
    }
}
