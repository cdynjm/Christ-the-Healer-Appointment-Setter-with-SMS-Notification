<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
       'id',
       'client_id',
       'queue',
       'time_id',
       'time',
       'start_time',
       'purpose',
       'date',
       'status',
       'admin_read',
       'user_read',
    ];

    public function Client() {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
