<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use Carbon\Carbon;

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
        $today = Carbon::today();
        $today = str_replace(' 00:00:00', '', $today);
        
        // 今日の入退店状況を取得
        $customers = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")->get();

        // 画面表示用に入店・退店時間のY-m-d部分を削除
        foreach ($customers as $customer) {
            $customer->enter_time = str_replace("$today ", '', $customer->enter_time);
            $customer->exit_time  = str_replace("$today ", '', $customer->exit_time);
        }

        return view('home')->with([
            'customers' => $customers,
        ]);
    }
}
