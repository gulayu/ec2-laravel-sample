<?php
namespace App\Services;

use App\Model\Customer;

class Utility
{
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

        // 平日の場合は学生も通常も同じ料金プランを適用
        if ($day_info === Customer::DAY_INFO_WEEKDAY) {
            $totalFee = $totalFee + self::weekdayPlan($stayTime);
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

    private static function weekdayPlan($stayTime)
    {
        // 平日料金の計算
        $first2hFee = 500;
        $extension1hFee = 250;
        $maxFee = 1000;
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    private static function weekendStudentPlan($stayTime)
    {
        // 休日学生の計算
        $first2hFee = 1000;
        $extension1hFee = 200;
        $maxFee = 1500;
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    private static function weekendNormalPlan($stayTime)
    {
        // 休日通常の計算
        $first2hFee = 1000;
        $extension1hFee = 250;
        $maxFee = 2000;
        $totalFee = self::baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee);

        return $totalFee;
    }

    private static function baseSystem($stayTime, $first2hFee, $extension1hFee, $maxFee) {
        // 2h未満の場合
        if ($stayTime <= config('const.time.2h')) {
            $fee = $first2hFee;
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
}