<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\BookingMail;
use App\Model\Booking;
use App\Services\Utility;
use App\Http\Requests\BookingRequest;
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
    public function check(BookingRequest $request)
    {
        // バリデーション
        $validated = $request->validated();

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
    public function create(BookingRequest $request)
    {
        // 予約の実行と修正ボタンのどちらを押したか確認
        $action = $request->get('do_booking', 'back');

        // 戻るボタンを押した場合は入力画面に返す
        if($action === 'back') {
            return redirect('booking')->withInput();
        }

        // バリデーション *booking_checkでバリデーションしてるので値は変わらない想定だが念のため
        $validated = $request->validated();

        // Bookingモデルを取得
        $booking = new Booking();
        // 入力値をセット
        $date_tmp = $request->input('date') . ' ' . $request->input('time');
        $booking->booking_number = Utility::generateRandomString();
        $booking->booking_date   = new Carbon($date_tmp);
        $booking->people         = $request->input('people');
        $booking->nickname       = $request->input('nickname');
        $booking->mail           = $request->input('mail');

        // bookingテーブルに追加
        $booking->save();

        // メール送信
        $content = collect();
        $content->booking_number = $booking->booking_number;
        $content->date           = $request->input('date');
        $content->time           = $request->input('time');
        $content->people         = $request->input('people');
        $content->nickname       = $request->input('nickname');
        $content->mail           = $request->input('mail');

        Mail::to($content->mail)->send(new BookingMail($content));

        return view('booking.complete')->with([

        ]);


    }
}
