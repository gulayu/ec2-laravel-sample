<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\BookingUpdateRequest;
use App\Services\BookingUtility;
use App\Model\Booking;
use App\Mail\BookingUpdateMail;
use Mail;

class BookingUpdateController extends Controller
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
     * index
     */
    public function index()
    {
        return view('booking_update.index');
    }

    /**
     * bookingNumberCheck
     * 入力された予約番号のチェック
     */
    public function bookingNumberCheck(Request $request)
    {
        $booking_number = null;

        // GETアクセスの場合
        if ($request->method() === 'GET') {
            if (is_null($request->old('booking_number'))) {
                // 直アクセスの場合は予約番号入力画面にリダイレクト
                return redirect()->route('booking_update_index');
            } else {
                // BookingUpdateController@checkでバリデーションエラーの場合
                // 予約変更画面再表示のために予約番号をold値から取得
                $booking_number = $request->old('booking_number');
            }
        }

        // POSTアクセスの場合$booking_numberに$request->input('booking_number')をセット
        if (is_null($booking_number)) {
            $booking_number = $request->input('booking_number');
        }

        // 指定の予約番号に該当するレコードを取得
        $targetBooking = Booking::where(Booking::BOOKING_NUMBER, $booking_number)->first();
        // 該当するレコードが存在しない場合、予約番号入力画面に戻す
        if (is_null($targetBooking)) {
            return redirect()
                ->route('booking_update_index')
                ->withInput()
                ->withErrors(array('booking_number' => '入力された管理番号は正しくありません'));
        }

        // bookings.booking_dateから日付と時刻を取得
        $booking_date = strtotime($targetBooking->booking_date);
        $targetBooking->date = date('Y-m-d', $booking_date);
        $targetBooking->time = date('H:i', $booking_date);

        // カレンダーの入力値制限用
        $today = BookingUtility::getToday();
        $twoMonthsLater = BookingUtility::getTwoMonthsLater();

        // 時刻の入力値制限用
        $step    = BookingUtility::TIME_STEP;
        $minTime = BookingUtility::TIME_MINTIME;
        $maxTime = BookingUtility::TIME_MAXTIME;

        return view('booking_update.update')->with([
            'targetBooking' => $targetBooking,
            'today'          => $today,
            'twoMonthsLater' => $twoMonthsLater,
            'step'           => $step,
            'minTime'        => $minTime,
            'maxTime'        => $maxTime,
        ]);
    }

    /**
     * check
     * 予約変更の実行
     */
    public function check(BookingUpdateRequest $request)
    {
        // バリデーション
        $validated = $request->validated();

        // 該当のレコードを取得
        $booking = Booking::where(Booking::BOOKING_NUMBER, $request->input('booking_number'))->first();
        // 入力値をセット
        $date_tmp = $request->input('date') . ' ' . $request->input('time');
        $booking->booking_date = new Carbon($date_tmp);
        $booking->people = $request->input('people');
        $booking->save();

        // メール送信
        $content = collect();
        $content->booking_number = $booking->booking_number;
        $content->date           = $request->input('date');
        $content->time           = $request->input('time');
        $content->people         = $request->input('people');
        $content->nickname       = $booking->nickname;
        $content->mail           = $booking->mail;

        Mail::to($content->mail)->send(new BookingUpdateMail($content));

        return view('booking_update.complete');
    }
}
