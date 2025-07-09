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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
        });

        DB::table('subcategories')->insert([
            ['category_id' => '1', 'name' => 'Platformer', 'slug' => 'platformer'],
            ['category_id' => '1', 'name' => 'Beat \'em up', 'slug' => 'beat_em_up'],
            ['category_id' => '1', 'name' => 'Fighting', 'slug' => 'fighting'],
            ['category_id' => '2', 'name' => 'Point \& Click', 'slug' => 'point_and_click'],
            ['category_id' => '2', 'name' => 'Visual Novel', 'slug' => 'visual_novel'],
            ['category_id' => '2', 'name' => 'Interactive Story', 'slug' => 'interactive_story'],
            ['category_id' => '3', 'name' => 'Turn-Based', 'slug' => 'turn_based'],
            ['category_id' => '3', 'name' => 'MMORPG', 'slug' => 'mmorpg'],
            ['category_id' => '3', 'name' => 'Action RPG', 'slug' => 'action_rpg'],
            ['category_id' => '4', 'name' => 'Flight Sim', 'slug' => 'flight_sim'],
            ['category_id' => '4', 'name' => ' Life Sim', 'slug' => 'life_sim'],
            ['category_id' => '4', 'name' => 'Farming Sim', 'slug' => 'farming_sim'],
            ['category_id' => '5', 'name' => 'Real-Time', 'slug' => 'real_time'],
            ['category_id' => '5', 'name' => 'Turn-Based', 'slug' => 'turn_based_strategy'],
            ['category_id' => '5', 'name' => 'Tower Defense', 'slug' => 'tower_defense'],
            ['category_id' => '6', 'name' => 'Football', 'slug' => 'football'],
            ['category_id' => '6', 'name' => 'Basketball', 'slug' => 'basketball'],
            ['category_id' => '6', 'name' => 'Extreme Sports', 'slug' => 'extreme_sports'],
            ['category_id' => '7', 'name' => 'Logic', 'slug' => 'logic'],
            ['category_id' => '7', 'name' => 'Match-3', 'slug' => 'match_3'],
            ['category_id' => '7', 'name' => 'Word Games', 'slug' => 'word_games'],
            ['category_id' => '8', 'name' => 'Survival', 'slug' => 'survival'],
            ['category_id' => '8', 'name' => 'Psychological', 'slug' => 'psychological'],
            ['category_id' => '8', 'name' => 'Gothic', 'slug' => 'gothic'],
            ['category_id' => '9', 'name' => 'FPS', 'slug' => 'fps'],
            ['category_id' => '9', 'name' => 'TPS', 'slug' => 'tps'],
            ['category_id' => '9', 'name' => 'Bullet Hell', 'slug' => 'bullet_hell'],
            ['category_id' => '10', 'name' => 'Arcade', 'slug' => 'arcade'],
            ['category_id' => '10', 'name' => 'Simulator', 'slug' => 'simulator'],
            ['category_id' => '10', 'name' => 'Kart Racer', 'slug' => 'kart_racer'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
