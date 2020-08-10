<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Customer;

class UserManagementController extends Controller
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
        return view('userManagement');
    }

    /**
     * 入退店処理
     */
    public function update(Request $request)
    {
        // 入店時処理
        if($request->enter_time) {
            // Customerモデルを取得
            $customer = new Customer();

            $customer->number       = $request->input('number');
            $customer->enter_time   = Carbon::now();
            $customer->day_info     = $request->input('day_info');
            $customer->member_info  = $request->input('member_info');
            $customer->use_drinkbar = $request->input('use_drinkbar');
            $customer->under_jrhigh = $request->input('under_jrhigh');
            // バリデーション（当日で同じ番号は使えないようにチェックする）
            

            // レコード追加
            $customer->save();

            // ログ表示用
            $info = collect();
            $info->type         = 'enter_time';
            $info->number       = $request->input('number');
            $info->enter_time   = Carbon::now();
            $info->day_info     = $request->input('day_info');
            $info->member_info  = $request->input('member_info');
            $info->use_drinkbar = $request->input('use_drinkbar');
            $info->under_jrhigh = $request->input('under_jrhigh');
        };

        // 退店時処理
        if ($request->exit_time) {
            // 対象のレコードを取得
            $customer = Customer::where(Customer::NUMBER, $request->input('number'))->first();
            $customer->exit_time = Carbon::now();
            // TODO:バリデーション（入力された番号が存在するかチェック）
            // レコード更新
            $customer->save();

            // ログ表示用
            $info = collect();
            $info->type   = 'exit_time';
            $info->number = $request->input('number');
            // TODO:料金の計算
        }

        return view('userManagement')->with([
            'info' => $info,
        ]);
    }
}
