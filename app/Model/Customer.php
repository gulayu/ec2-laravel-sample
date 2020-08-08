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
}
