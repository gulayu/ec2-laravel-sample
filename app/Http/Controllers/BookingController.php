<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\BookingMail;
use Mail;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 予約画面はアクセス制限をかけない
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // カレンダーの入力値制限用
        $today = Carbon::now();
        $twoMonthsLater = Carbon::now()->addMonth(2)->format('Y-m-d');

        // 時刻の入力値制限用
        $step    = '900';
        $minTime = '12:00:00';
        $maxTime = '19:00:00';

        return view('booking.index')->with([
            'today'          => $today,
            'twoMonthsLater' => $twoMonthsLater,
            'step'           => $step,
            'minTime'        => $minTime,
            'maxTime'        => $maxTime,
        ]);
    }

    /**
     * 予約情報の確認
     */
    public function check(Request $request)
    {
        // バリデーション
        $validatedDataEnter = $request->validate([
            'date'     => 'required|date',
            'time'     => 'required|date_format:H:i',
            'people'   => 'required|numeric|between:1,30',
            'nickname' => 'required|string|between:1,20',
            'mail'     => 'required|email'
        ]);

        // 入力情報の取得
        $bookingInfo = collect();
        $bookingInfo->date      = $request->input('date');
        $bookingInfo->time      = $request->input('time');
        $bookingInfo->people    = $request->input('people');
        $bookingInfo->nickname  = $request->input('nickname');
        $bookingInfo->mail      = $request->input('mail');


        return view('booking.check')->with([
            'bookingInfo' => $bookingInfo
        ]);
    }

    /**
     * 予約の実行
     */
    public function create(Request $request)
    {
        $action = $request->get('do_booking', 'back');

        // 戻るボタンを押した場合
        if($action === 'back') {
            return redirect('booking')->withInput();
        }

        // メール送信
        // TODO:メール送信まではOK。照会番号の添付
        $content = collect();
        $content->date      = $request->input('date');
        $content->time      = $request->input('time');
        $content->people    = $request->input('people');
        $content->nickname  = $request->input('nickname');
        $content->mail      = $request->input('mail');

        Mail::to($content->mail)->send(new BookingMail($content));

        return view('booking.complete')->with([

        ]);


    }
}
