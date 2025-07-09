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
        Schema::create('game_platforms', function (Blueprint $table) {
            $table->primary(['game_id', 'platform_id']);
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
        });

        DB::table('game_platforms')->insert([
            ['game_id' => '1', 'platform_id' => '7',],
            ['game_id' => '1', 'platform_id' => '8',],
            ['game_id' => '1', 'platform_id' => '9',],
            ['game_id' => '2', 'platform_id' => '9',],
            ['game_id' => '2', 'platform_id' => '6',],
            ['game_id' => '3', 'platform_id' => '3',],
            ['game_id' => '3', 'platform_id' => '9',],
            ['game_id' => '3', 'platform_id' => '7',],
            ['game_id' => '3', 'platform_id' => '8',],
            ['game_id' => '3', 'platform_id' => '10',],
            ['game_id' => '3', 'platform_id' => '2',],
            ['game_id' => '3', 'platform_id' => '4',],
            ['game_id' => '3', 'platform_id' => '5',],
            ['game_id' => '3', 'platform_id' => '1',],
            ['game_id' => '3', 'platform_id' => '11',],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_platforms');
    }
};
