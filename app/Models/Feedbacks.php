<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
       'id',
       'client_id',
       'comment',
       'rating'
    ];

    public function Client() {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
