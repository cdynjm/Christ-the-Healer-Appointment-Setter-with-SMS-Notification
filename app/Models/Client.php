<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';

    protected $fillable = [
       'id',
       'lastname',
       'firstname',
       'middlename',
       'address',
       'birthdate',
       'contact_number',
       'gender',
       'valid_id',
       'photo'
    ];

    public function User() {
        return $this->hasOne(User::class, 'client_id', 'id');
    }
}
