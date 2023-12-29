<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('first_name');
            $table->string('last_name');
            
            // 電話番号のカラムを追加（必須ではない）
            $table->string('phone')->nullable();
            
            // 性別と趣味のカラムを追加
            $table->string('gender');
            $table->string('hobby')->nullable();
            
            // 既存のnameカラムを削除
            $table->dropColumn('name');
            
            // email_verified_atカラムを削除
            $table->dropColumn('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 変更をロールバックするコードを追加
            $table->dropColumn(['first_name', 'last_name', 'phone', 'gender', 'hobby']);

            // 元のnameカラムを復元
            $table->string('name');
            
            // email_verified_atカラムを復元
            $table->timestamp('email_verified_at')->nullable();
        });
    }
};
