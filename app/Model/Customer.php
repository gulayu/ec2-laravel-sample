<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    const NUMBER       = 'number';
    const ENTER_TIME   = 'enter_time';
    const EXIT_TIME    = 'exit_time';
    const DAY_INFO     = 'day_info';
    const MEMBER_INFO  = 'member_info';
    const USE_DRINKBAR = 'use_drinkbar';
    const UNDER_JRHIGH = 'under_jrhigh';
    const FEE          = 'fee';
    const MEMO         = 'memo';
    const CREATED_AT   = 'created_at';
    const UPDATED_AT   = 'updated_at';

    const MEMBER_INFO_SOLO = 1;
    const MEMBER_INFO_GROUP = 2;
    const DAY_INFO_WEEKDAY = 1;
    const DAY_INFO_WEEKEND = 2;
    const USE_DRINKBAR_TRUE = 1;
    const UNDER_JRHIGH_TRUE = 1;

    const UNDER_JRHIGH_FEE = 500;
    const DRINKBAR_FEE = 500;

    //------------テーブル表示用-----------------------
    // 個人orグループ
    public static function setMemberInfoDisplay($memberInfo) {
        return config('const.Customers.member_info')[$memberInfo];
    }

    // 平日or休日
    public static function setDayInfoDisplay($dayInfo) {
        return config('const.Customers.day_info')[$dayInfo];
    }

    // ドリンクバー利用有無
    public static function setUseDrinkbarDisplay($useDrinkbar) {
        return config('const.Customers.use_drinkbar')[$useDrinkbar];
    }

    // 中学生料金
    public static function setUnderJrhighDisplay($underJrhigh) {
        return config('const.Customers.under_jrhigh')[$underJrhigh];
    }

    //------------編集画面表示用-----------------------
    // 入店・退店時間
    public static function setTimeDisplay($date) {
        $today = Carbon::today();
        $today = str_replace(' 00:00:00', '', $today);

        return str_replace("$today ", '', $date);
    }

    // 平日or休日
    public static function isWeekday($day_info) {
        if ($day_info === 1) {
            return true;
        }
        return false;
    }
    public static function isWeekend($day_info) {
        if ($day_info === 2) {
            return true;
        }
        return false;
    }

    // 相席orグループ
    public static function isSolo($member_info) {
        if ($member_info === 1) {
            return true;
        }
        return false;
    }
    public static function isGroup($member_info) {
        if ($member_info === 2) {
            return true;
        }
        return false;
    }

    // ドリンクバー利用有無
    public static function hasDrinkbar($useDrinkbar) {
        if ($useDrinkbar === 1) {
            return true;
        }
        return false;
    }

    // 中学生かどうか
    public static function isUnderJrhigh($underJrhigh) {
        if ($underJrhigh === 1) {
            return true;
        }
        return false;
    }
}
