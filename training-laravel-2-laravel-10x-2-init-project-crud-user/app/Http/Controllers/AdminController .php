<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tour;
use App\Models\Location;
use App\Models\Guide;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin dashboard
     */
    public function adminHome()
    {
        return view('crud_user.adminhome'); // Đường dẫn view đã được cập nhật
    }

    /**
     * List of tours for admin
     */
    public function listTour()
    {
        if (Auth::check() && Auth::user()->is_admin === 1) {
            $tours = Tour::orderBy('tour_id', 'desc')->with(['location', 'guide'])->get();
            return view('crud_user.listtour', ['tours' => $tours]); // Đường dẫn view đã được cập nhật
        }

        return redirect("login")->withSuccess('Bạn không có quyền truy cập');
    }
    public function listLocation()
    {
        if (Auth::check() && Auth::user()->is_admin === 1) {
            $locations = Location::orderBy('id', 'desc')->get(); // Lấy tất cả địa điểm
            return view('crud_user.listlocation', ['locations' => $locations]); // Tạo view listlocation.blade.php
        }

        return redirect("login")->withSuccess('Bạn không có quyền truy cập');
    }
    public function listGuide()
    {
        if (Auth::check() && Auth::user()->is_admin === 1) {
            $guides = Guide::orderBy('id', 'desc')->get();
            return view('crud_user.listguide', ['guides' => $guides]); // Tạo view listguide.blade.php
        }

        return redirect("login")->withSuccess('Bạn không có quyền truy cập');
    }
}