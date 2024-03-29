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
        Schema::create('user_followers_pivot', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\User::class, 'followed_by');
            $table->unique(['user_id', 'followed_by']);
            $table->timestamp('following_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_followers_pivot');
    }
};
