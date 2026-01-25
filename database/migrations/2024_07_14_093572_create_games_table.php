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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->string('cover_image');
            $table->string('developer');
            $table->string('publisher');
            $table->string('slug');
            $table->dateTime('release_date', precision: 0);
        });

        DB::table('games')->insert([
            [
                'category_id' => 3,
                'subcategory_id' => 9,
                'name' => 'Horizon Forbidden West',
                'description' => 'Open-world action RPG where Aloy explores vast post-apocalyptic lands, combatting machines and uncovering ancient secrets with new tools and underwater regions.',
                'cover_image' => 'horizon_forbidden_west_thumb.jpg',
                'developer' => 'Guerrilla Games (Windows port by Nixxes Software)',
                'publisher' => 'Sony Interactive Entertainment',
                'slug' => 'horizon-forbidden-west',
                'release_date' => '2022-02-18 00:00:00',
            ],
            [
                'category_id' => 5,
                'subcategory_id' => 13,
                'name' => 'League of Legends',
                'description' => 'Free-to-play MOBA where teams of five champions compete to destroy the enemy Nexus. Features strategic gameplay, diverse champions, and a large global esports community.',
                'cover_image' => 'league_of_legends_thumb.jpg',
                'developer' => 'Riot Games',
                'publisher' => 'Riot Games',
                'slug' => 'league-of-legends',
                'release_date' => '2009-10-27 00:00:00',
            ],
            [
                'category_id' => 9,
                'subcategory_id' => 25,
                'name' => 'Fortnite',
                'description' => 'Popular online multiplayer game with Battle Royale, Creative, and PvE modes. Players fight to be the last alive, build structures, and engage in frequent live events.',
                'cover_image' => 'fornite_thumb.jpg',
                'developer' => 'Epic Games',
                'publisher' => 'Epic Games',
                'slug' => 'fortnite',
                'release_date' => '2017-07-25 00:00:00',
            ],
            [
                'category_id' => 4,
                'subcategory_id' => 11,
                'name' => 'Minecraft',
                'description' => 'Sandbox survival game where players explore infinite worlds, gather resources, craft items, build structures, and battle mobs alone or with others.',
                'cover_image' => 'minecraft_thumb.jpg',
                'developer' => 'Mojang Studios',
                'publisher' => 'Mojang Studios / Microsoft',
                'slug' => 'minecraft',
                'release_date' => '2011-11-18 00:00:00',
            ],
            [
                'category_id' => 4,
                'subcategory_id' => 11,
                'name' => 'Roblox',
                'description' => 'Game creation platform where users play and build games across genres. Features a vast catalog of player-made experiences and an active virtual economy.',
                'cover_image' => 'roblox_thumb.jpg',
                'developer' => 'Roblox Corporation',
                'publisher' => 'Roblox Corporation',
                'slug' => 'roblox',
                'release_date' => '2006-09-01 00:00:00',
            ],
            [
                'category_id' => 1,
                'subcategory_id' => 1,
                'name' => 'Grand Theft Auto V',
                'description' => 'Open-world action-adventure focusing on three protagonists in the fictional state of San Andreas, blending story missions with wide exploration and online play.',
                'cover_image' => 'gta5_thumb.jpg',
                'developer' => 'Rockstar North',
                'publisher' => 'Rockstar Games',
                'slug' => 'grand-theft-auto-v',
                'release_date' => '2013-09-17 00:00:00',
            ],
            [
                'category_id' => 9,
                'subcategory_id' => 25,
                'name' => 'Free Fire',
                'description' => 'Mobile battle royale where players fight in short matches to be last alive, with character abilities, tactical items, and ranked competition.',
                'cover_image' => 'free_fire_thumb.jpg',
                'developer' => 'Garena',
                'publisher' => 'Garena',
                'slug' => 'free-fire',
                'release_date' => '2017-12-08 00:00:00',
            ],
            [
                'category_id' => 5,
                'subcategory_id' => 14,
                'name' => 'Honor of Kings',
                'description' => 'Top-grossing mobile MOBA where players control heroes with unique skills to destroy enemy towers in fast-paced team battles.',
                'cover_image' => 'honor_of_kings_thumb.jpg',
                'developer' => 'TiMi Studio Group',
                'publisher' => 'Tencent Games',
                'slug' => 'honor-of-kings',
                'release_date' => '2015-11-26 00:00:00',
            ],
            [
                'category_id' => 9,
                'subcategory_id' => 25,
                'name' => 'Valorant',
                'description' => 'Tactical 5v5 hero shooter where agents use abilities and gunplay to complete objectives, with strategic depth and competitive ranked modes.',
                'cover_image' => 'valorant_thumb.jpg',
                'developer' => 'Riot Games',
                'publisher' => 'Riot Games',
                'slug' => 'valorant',
                'release_date' => '2020-06-02 00:00:00',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
