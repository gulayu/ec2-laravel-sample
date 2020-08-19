<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeePlan extends Model
{
    const TYPE             = 'type';
    const FIRST_2H_FEE     = 'first_2h_fee';
    const EXTENSION_1H_FEE = 'extension_1h_fee';
    const MAX_FEE          = 'max_fee';

    const WEEKDAYSTUDENT = 'weekdayStudent';
    const WEEKDAYNORMAL  = 'weekdayNormal';
    const WEEKENDSTUDENT = 'weekendStudent';
    const WEEKENDNORMAL  = 'weekendNormal';

    public static function setTypeDisplay($type) {
        switch ($type) {
            case "weekdayStudent":
                echo "平日学生";
                break;
            case "weekdayNormal":
                echo "平日一般";
                break;
            case "weekendStudent":
                echo "休日学生";
                break;
            case "weekendNormal":
                echo "休日一般";
                break;
        }
    }

    public static function setFirst2hFeeFormDisplay($type) {
        return $type . 'First2hFee';
    }

    public static function setExtension1hFeeFormDisplay($type) {
        return $type . 'Extension1hFee';
    }

    public static function setMaxFeeFormDisplay($type) {
        return $type . 'MaxFee';
    }
}
