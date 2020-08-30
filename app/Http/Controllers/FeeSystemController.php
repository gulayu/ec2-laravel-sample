<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FeePlan;

class FeeSystemController extends Controller
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
     * 料金システム編集画面
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 各料金の取得
        $feePlans = FeePlan::all();
        return view('feeSystem')->with([
            'feePlans' => $feePlans,
        ]);
    }

    /**
     * 入退店処理
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request) {
        // 簡単なバリデーション
        $validatedData = $request->validate([
            'weekdayStudentFirst2hFee'     => 'required|numeric',
            'weekdayStudentExtension1hFee' => 'required|numeric',
            'weekdayStudentMaxFee'         => 'required|numeric',
            'weekdayNormalFirst2hFee'      => 'required|numeric',
            'weekdayNormalExtension1hFee'  => 'required|numeric',
            'weekdayNormalMaxFee'          => 'required|numeric',
            'weekendStudentFirst2hFee'     => 'required|numeric',
            'weekendStudentExtension1hFee' => 'required|numeric',
            'weekendStudentMaxFee'         => 'required|numeric',
            'weekendNormalFirst2hFee'      => 'required|numeric',
            'weekendNormalExtension1hFee'  => 'required|numeric',
            'weekendNormalMaxFee'          => 'required|numeric',
        ]);

        // 対象のFeePlanレコードを取得
        $feePlanWeekdayStudent = FeePlan::where(FeePlan::TYPE, FeePlan::WEEKDAYSTUDENT)->first();
        $feePlanWeekdayNormal  = FeePlan::where(FeePlan::TYPE, FeePlan::WEEKDAYNORMAL)->first();
        $feePlanWeekendStudent = FeePlan::where(FeePlan::TYPE, FeePlan::WEEKENDSTUDENT)->first();
        $feePlanWeekendNormal  = FeePlan::where(FeePlan::TYPE, FeePlan::WEEKENDNORMAL)->first();
        // 入力値をセット
        $feePlanWeekdayStudent->first_2h_fee     = $request->input('weekdayStudentFirst2hFee');
        $feePlanWeekdayStudent->extension_1h_fee = $request->input('weekdayStudentExtension1hFee');
        $feePlanWeekdayStudent->max_fee          = $request->input('weekdayStudentMaxFee');
        $feePlanWeekdayNormal->first_2h_fee      = $request->input('weekdayNormalFirst2hFee');
        $feePlanWeekdayNormal->extension_1h_fee  = $request->input('weekdayNormalExtension1hFee');
        $feePlanWeekdayNormal->max_fee           = $request->input('weekdayNormalMaxFee');
        $feePlanWeekendStudent->first_2h_fee     = $request->input('weekendStudentFirst2hFee');
        $feePlanWeekendStudent->extension_1h_fee = $request->input('weekendStudentExtension1hFee');
        $feePlanWeekendStudent->max_fee          = $request->input('weekendStudentMaxFee');
        $feePlanWeekendNormal->first_2h_fee      = $request->input('weekendNormalFirst2hFee');
        $feePlanWeekendNormal->extension_1h_fee  = $request->input('weekendNormalExtension1hFee');
        $feePlanWeekendNormal->max_fee           = $request->input('weekendNormalMaxFee');
        // レコード更新
        $feePlanWeekdayStudent->save();
        $feePlanWeekdayNormal->save();
        $feePlanWeekendStudent->save();
        $feePlanWeekendNormal->save();

        // ログ表示用
        $info = collect();
        $info->res   = 'ok';
        
        // 各料金の取得
        $feePlans = FeePlan::all();
        
        return view('feeSystem')->with([
            'info' => $info,
            'feePlans' => $feePlans,
        ]);
    }
}
