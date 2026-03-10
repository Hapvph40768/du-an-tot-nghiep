<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $users = User::all();
        $bookings = DB::table('bookings')->get();
        $trips = DB::table('trips')->get();

        return view('admin.reviews.create', compact('users', 'bookings', 'trips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'trip_id' => 'required|exists:trips,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        Review::create($validated);

        // Redirect admin to admin reviews index, customers back to previous page
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được tạo.');
        }

        return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá.');
    }

    public function show(Review $review)
    {
        $review->load(['user']);
        return view('admin.reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $users = User::all();
        $bookings = DB::table('bookings')->get();
        $trips = DB::table('trips')->get();

        return view('admin.reviews.edit', compact('review', 'users', 'bookings', 'trips'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'trip_id' => 'required|exists:trips,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        $review->update($validated);

        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được cập nhật.');
        }

        return back()->with('success', 'Đánh giá đã được cập nhật.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được xóa.');
        }

        return back()->with('success', 'Đánh giá đã được xóa.');
    }
}
