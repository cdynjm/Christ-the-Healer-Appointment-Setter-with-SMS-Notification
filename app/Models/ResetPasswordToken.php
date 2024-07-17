<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordToken extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';

    protected $fillable = [
        'id',
        'email',
        'phone_number',
        'code'
    ];
}
