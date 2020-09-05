<?php
namespace App\Services;

use Carbon\Carbon;
use App\Model\Customer;
use App\Model\FeePlan;

class Utility
{
    /**
     * 滞在時間に応じた料金を計算
     * @param int $number
     * @param string $enter_time YYYY-mm-dd H:i:s
     * @param string $exit_time YYYY-mm-dd H:i:s
     * @param int $day_info
     * @param int $use_drinkbar
     * @param int $under_jrhigh
     * 
     * @return int
     */
    public static function calcPlaySpaceFee($number, $enter_time, $exit_time, $day_info, $use_drinkbar, $under_jrhigh)
    {
        // 戻り値となる最終的な料金を格納する変数
        $totalFee = 0;

        // 経過時間の計算（単位：秒）
        $stayTime = strtotime($exit_time) - strtotime($enter_time);

        // ドリンクバー利用の場合は追加料金
        if ($use_drinkbar === Customer::USE_DRINKBAR_TRUE) {
            $totalFee = $totalFee + Customer::DRINKBAR_FEE;
        }

        // 中学生未満の場合は一律料金
        if ($under_jrhigh === Customer::UNDER_JRHIGH_TRUE) {
            $totalFee = $totalFee + Customer::UNDER_JRHIGH_FEE;
            return $totalFee;
        }

        // 平日学生プランの場合
        if ($day_info === Customer::DAY_INFO_WEEKDAY && $number >= 100) {
            $totalFee = $totalFee + self::weekdayStudentPlan($stayTime);
            return $totalFee;
        }

        // 平日通常プランの場合
        if ($day_info === Customer::DAY_INFO_WEEKDAY && $number < 100) {
            $totalFee = $totalFee + self::weekdayNormalPlan($stayTime);
            return $totalFee;
        }

        // 休日学生プランの場合（学生の場合管理番号が100以上になる）
        if ($day_info === Customer::DAY_INFO_WEEKEND && $number >= 100) {
            $totalFee = $totalFee + self::weekendStudentPlan($stayTime);
            return $totalFee;
        }

        // 休日通常プランの場合
        if ($day_info === Customer::DAY_INFO_WEEKEND && $number < 100) {
            $totalFee = $totalFee + self::weekendNormalPlan($stayTime);
            return $totalFee;
        }
    }

    /**
     * 平日学生料金の計算
     * @param int $stayTime
     * 
     * @return int 
     */
    private static function weekdayStudentPlan($stayTime)
    {
        // 料金の取得
        $feePlan = FeePlan::where(FeePlan::TYPE, 'weekdayStudent')->first();
        $first2hFee     = $feePlan->first_2h_fee;
        $extension1hFee = $feePlan->extension_1h_fee;
        $maxFee         = $feePlan->max_fee;

        // 平日学生料金の計算
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    /**
     * 平日通常料金の計算
     * @param int $stayTime
     * 
     * @return int 
     */
    private static function weekdayNormalPlan($stayTime)
    {
        // 料金の取得
        $feePlan = FeePlan::where(FeePlan::TYPE, 'weekdayNormal')->first();
        $first2hFee     = $feePlan->first_2h_fee;
        $extension1hFee = $feePlan->extension_1h_fee;
        $maxFee         = $feePlan->max_fee;

        // 平日通常料金の計算
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    /**
     * 休日学生料金の計算
     * @param int $stayTime
     * 
     * @return int 
     */
    private static function weekendStudentPlan($stayTime)
    {
        // 料金の取得
        $feePlan = FeePlan::where(FeePlan::TYPE, 'weekendStudent')->first();
        $first2hFee     = $feePlan->first_2h_fee;
        $extension1hFee = $feePlan->extension_1h_fee;
        $maxFee         = $feePlan->max_fee;

        // 休日学生の計算
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    /**
     * 平日通常料金の計算
     * @param int $stayTime
     * 
     * @return int 
     */
    private static function weekendNormalPlan($stayTime)
    {
        // 料金の取得
        $feePlan = FeePlan::where(FeePlan::TYPE, 'weekendNormal')->first();
        $first2hFee     = $feePlan->first_2h_fee;
        $extension1hFee = $feePlan->extension_1h_fee;
        $maxFee         = $feePlan->max_fee;

        // 休日通常の計算
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    /**
     * 料金計算のベース
     * @param int $stayTime
     * @param int $first2hFee
     * @param int $extension1hFee
     * @param int $maxFee
     * 
     * @return int
     */
    private static function baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee) {
        // 2h未満の場合
        if ($stayTime <= config('const.time.2h')) {
            $fee = $first2hFee;
            // 最大料金との比較（最初の2時間が最大料金より高いことはあり得ないけど一応）
            if ($fee > $maxFee) {
                $fee = $maxFee; 
            }

            return $fee;
        }

        // 2h以降
        if ($stayTime <= config('const.time.3h')) {
            $fee = $first2hFee + $extension1hFee;
        } else if ($stayTime <= config('const.time.4h')) {
            $fee = $first2hFee + $extension1hFee * 2;
        } else if ($stayTime <= config('const.time.5h')) {
            $fee = $first2hFee + $extension1hFee * 3;
        } else if ($stayTime <= config('const.time.6h')) {
            $fee = $first2hFee + $extension1hFee * 4;
        } else if ($stayTime <= config('const.time.7h')) {
            $fee = $first2hFee + $extension1hFee * 5;
        } else if ($stayTime <= config('const.time.8h')) {
            $fee = $first2hFee + $extension1hFee * 6;
        } else if ($stayTime <= config('const.time.9h')) {
            $fee = $first2hFee + $extension1hFee * 7;
        } else if ($stayTime <= config('const.time.10h')) {
            $fee = $first2hFee + $extension1hFee * 8;
        }

        // 最大料金との比較
        if ($fee > $maxFee) {
            $fee = $maxFee; 
        }

        return $fee;
    }

    /**
     * 今日の日付を取得
     * 
     * @return string YYYY-mm-dd
     * 
     */
    public static function getToday() {
        $today = Carbon::today();
        $today = str_replace(' 00:00:00', '', $today);

        return $today;
    }

    /**
     * 今日の入退店状況を取得
     * @param string $today YYYY-mm-dd
     * 
     * @return collection
     */
    public static function getTodayCustomers($today) {
        $customers = Customer::where(Customer::ENTER_TIME, 'LIKE', "$today%")->get();

        // 画面表示用に入店・退店時間のY-m-d部分を削除
        foreach ($customers as $customer) {
            $customer->enter_time = str_replace("$today ", '', $customer->enter_time);
            $customer->exit_time  = str_replace("$today ", '', $customer->exit_time);
        }
        
        return $customers;
    }

    
}