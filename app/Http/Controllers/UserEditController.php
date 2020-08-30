<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Customer;

class UserEditController extends Controller
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
     * 入退店編集
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editEntry($number) {
        // 今日の日付を取得
        $today = Carbon::today();
        $today = str_replace(' 00:00:00', '', $today);

        // 今日の入退店状況を取得
        $customers = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")->get();

        // 画面表示用に入店・退店時間のY-m-d部分を削除
        foreach ($customers as $customer) {
            $customer->enter_time = str_replace("$today ", '', $customer->enter_time);
            $customer->exit_time  = str_replace("$today ", '', $customer->exit_time);
        }

        // 編集対象のユーザを取得
        $targetCustomer = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")
                        ->where(Customer::NUMBER, $number)
                        ->first();


        return view('userEdit')->with([
            'customers' => $customers,
            'targetCustomer' => $targetCustomer,
        ]);
    }
}
