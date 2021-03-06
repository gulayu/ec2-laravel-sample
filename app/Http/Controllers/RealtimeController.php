<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use Carbon\Carbon;
use App\Services\Utility;

class RealtimeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // リアルタイム状況確認画面はアクセス制限をかけない
        // $this->middleware('auth');
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

        // 退店処理がされていない顧客を相席、グループそれぞれで取得
        $soloPlayers  = $customers->where(Customer::EXIT_TIME, '')->where(Customer::MEMBER_INFO, Customer::MEMBER_INFO_SOLO);
        $groupPlayers = $customers->where(Customer::EXIT_TIME, '')->where(Customer::MEMBER_INFO, Customer::MEMBER_INFO_GROUP);

        // それぞれの人数を取得
        $soloPlayersCount  = count($soloPlayers);
        $groupPlayersCount = count($groupPlayers);

        return view('realtime')->with([
            'soloPlayersCount'  => $soloPlayersCount,
            'groupPlayersCount' => $groupPlayersCount,
        ]);
    }
}
