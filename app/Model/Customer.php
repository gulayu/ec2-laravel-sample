<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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
}
