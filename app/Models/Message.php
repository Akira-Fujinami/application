<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'messages';

    protected $fillable = [
        'your_id',
        'my_id',
        'text'
    ];
}