<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancel extends Model
{
    use HasFactory;

    protected $table = 'cancel';

    protected $fillable = [
       'id',
       'userid',
       'reason'
    ];

    public function Client() {
        return $this->hasOne(Client::class, 'id', 'userid');
    }
}
