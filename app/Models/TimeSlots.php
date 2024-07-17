<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;

    protected $table = 'time_slots';

    protected $fillable = [
       'id',
       'from_time',
       'to_time',
       'schedule'
    ];
}
