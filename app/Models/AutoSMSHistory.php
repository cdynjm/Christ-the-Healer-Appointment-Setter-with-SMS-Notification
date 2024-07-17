<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoSMSHistory extends Model
{
    use HasFactory;

    protected $table = 'auto_sms_history';

    protected $fillable = [
       'id',
       'appointment_id',
       'time',
       'date',
    ];
}
