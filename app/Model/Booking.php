<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const ID             = 'id';
    const BOOKING_NUMBER = 'booking_number';
    const BOOKING_DATE   = 'booking_date';
    const PEOPLE         = 'people';
    const NICKNAME       = 'nickname';
    const MAIL           = 'mail';
    const CREATED_AT     = 'created_at';
    const UPDATED_AT     = 'updated_at';
}
