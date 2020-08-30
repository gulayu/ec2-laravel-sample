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

    private function weekdayPlan($stayTime)
    {
        // 平日料金の計算
    }

    private function weekendStudentPlan($stayTime)
    {
        // 休日学生の計算
    }

    private function weekendNormalPlan($stayTime)
    {
        // 休日通常の計算
    }
}