<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commant extends Model
{

    use HasFactory;
     protected $fillable = [
        'username',
        'commant',
        'user_id',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
