<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Customer;
use App\Services\Utility;

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
     * 入退店編集画面
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editEntry($number) {
        // 今日の日付を取得（Y-m-d）
        $today = Utility::getToday();
        
        // 今日の入退店状況を取得
        $customers = Utility::getTodayCustomers($today);

        // 編集対象のユーザを取得
        $targetCustomer = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")
                        ->where(Customer::NUMBER, $number)
                        ->first();


        return view('userEdit')->with([
            'targetCustomer' => $targetCustomer,
            'customers'      => $customers,
        ]);
    }

    /**
     * 編集実行
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request) {
        // 今日の日付を取得
        $today = Utility::getToday();

        // 簡単なバリデーション
        $validatedDataEnter = $request->validate([
            'enter_time' => 'required|date_format:H:i:s',
            'exit_time'  => 'nullable|date_format:H:i:s',
            'fee'        => 'nullable|numeric|between:0,9999',
            'memo'       => 'nullable|string|max:30',
        ]);

        // 対象のレコードを取得
        $customer = Customer::where(Customer::ID, $request->input('id'))->first();

        // 入力値をセット
        $customer->enter_time   = $today . ' ' . $request->input('enter_time');
        if (is_null($request->input('exit_time'))) {
            $customer->exit_time = null;    
        } else {
            $customer->exit_time = $today . ' ' . $request->input('exit_time');
        }
        $customer->day_info     = $request->input('day_info');
        $customer->member_info  = $request->input('member_info');
        $customer->use_drinkbar = $request->input('use_drinkbar');
        $customer->under_jrhigh = $request->input('under_jrhigh');
        $customer->fee          = $request->input('fee');
        $customer->memo         = $request->input('memo');

        // レコード更新
        $customer->save();

        // 編集実行後のユーザを再取得
        $targetCustomer = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")
                        ->where(Customer::ID, $request->input('id'))
                        ->first();

        // ログ表示用
        $info = collect();
        $info->type   = 'edit_done';
        $info->number = $targetCustomer->number;

        // 今日の入退店状況を取得
        $customers = Utility::getTodayCustomers($today);

        return view('userEdit')->with([
            'targetCustomer' => $targetCustomer,
            'customers'      => $customers,
            'info'           => $info,
        ]);
    }
}
