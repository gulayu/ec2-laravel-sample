<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use Carbon\Carbon;
use App\Services\Utility;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 今日の日付を取得（Y-m-d）
        $today = Utility::getToday();
        
        // 今日の入退店状況を取得
        $customers = Utility::getTodayCustomers($today);

        return view('home')->with([
            'customers' => $customers,
        ]);
    }
}
