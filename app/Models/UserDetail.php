<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    // モデルが使用するテーブル名を指定
    protected $table = 'user_detail';

    // テーブルの主キーを指定
    protected $primaryKey = 'id';

    // マスアサインメントを許可するカラムを指定
    protected $fillable = [
        'user_id',
        'oneWord',
        'introduction',
    ];

    // タイムスタンプを使用しない場合は false を設定
    public $timestamps = true;

    public function user()
{
    return $this->belongsTo('App\Models\User', 'user_id');
}

}