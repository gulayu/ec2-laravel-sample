<?php
namespace App\Services;

use Carbon\Carbon;

class BookingUtility
{
    const TIME_STEP = '900';
    const TIME_MINTIME = '12:00:00';
    const TIME_MAXTIME = '19:00:00';

    /**
     * 今日の日付を取得
     * 
     * @return object
     */
    public static function getToday()
    {
        return Carbon::now();
    }

    /**
     * ２ヶ月後の日付を取得
     * 
     * @return object
     */
    public static function getTwoMonthsLater()
    {
        return Carbon::now()->addMonth(2)->format('Y-m-d');
    }

    /**
     * ランダムな文字列を生成
     * 
     * @param int $length
     * 
     * @return string
     */
    public static function generateRandomString($length = 6) {
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
}