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

    }
}
