<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_points',
        'rank',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
