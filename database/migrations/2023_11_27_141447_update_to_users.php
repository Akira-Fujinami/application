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
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('hobby');
            $table->unsignedInteger('age')->nullable();
            $table->string('live');
            $table->string('name');
            $table->json('hobbies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('hobby')->nullable();
            
            // Drop the columns that were added
            $table->dropColumn('age');
            $table->dropColumn('live');
            $table->dropColumn('name');
            $table->dropColumn('hobbies');
        });
    }
};
