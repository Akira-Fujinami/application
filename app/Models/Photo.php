<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo_id',
        'user_id',
        'path',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
