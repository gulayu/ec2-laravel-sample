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
            // 簡単なバリデーション
            $validatedDataEnter = $request->validate([
                'number'      => 'required|numeric',
                'day_info'    => 'required|between:1,2',
                'member_info' => 'required|between:1,2',
            ]);

            // Customerモデルを取得
            $customer = new Customer();
            // 入力値をセット
            $customer->number       = $request->input('number');
            $customer->enter_time   = Carbon::now();
            $customer->day_info     = $request->input('day_info');
            $customer->member_info  = $request->input('member_info');
            $customer->use_drinkbar = $request->input('use_drinkbar');
            $customer->under_jrhigh = $request->input('under_jrhigh');

            // 当日に同じ番号がないか確認
            $today = Carbon::today();
            $today = str_replace(' 00:00:00', '', $today);
            $checkSameNumber = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")
                            ->where(Customer::NUMBER, $customer->number)
                            ->count();
            // 同じ番号が存在する場合、レコードを追加せずにエラーを返す
            if ($checkSameNumber > 0) {
                return redirect('userManagement')->with('enter_time_error', '当日の管理表に同じ管理番号が存在します');
            }

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
            // 簡単なバリデーション
            $validatedDataExit = $request->validate([
                'number'      => 'required|numeric',
            ]);

            // 当日に同じ番号があることを確認
            $checkSameNumber = Customer::where(Customer::NUMBER, $request->input('number'))->count();
            // 同じ番号がない場合、レコードを追加せずエラーを返す
            if ($checkSameNumber === 0) {
                return redirect('userManagement')->with('exit_time_error', '当日の管理表に同じ管理番号が存在しませんでした');
            }

            // 対象のレコードを取得
            $customer = Customer::where(Customer::NUMBER, $request->input('number'))->first();
            $customer->exit_time = Carbon::now();

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
