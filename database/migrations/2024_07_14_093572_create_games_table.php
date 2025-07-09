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
                'description' => '',
                'cover_image' => 'horizon_forbidden_west_thumb.jpg',
                'developer' => '',
                'publisher' => '',
                'slug' => '',
                'release_date' => '2025-07-06 14:30:00',
            ],
            [
                'category_id' => 5,
                'subcategory_id' => 13, 
                'name' => 'League of Legends',
                'description' => '',
                'cover_image' => 'league_of_legends_thumb.jpg',
                'developer' => '',
                'publisher' => '',
                'slug' => '',
                'release_date' => '2025-07-06 14:30:00',
            ],
            [
                'category_id' => 9, 
                'subcategory_id' => 26, 
                'name' => 'Fortnite',
                'description' => '',
                'cover_image' => 'fornite_thumb.jpg', 
                'developer' => '',
                'publisher' => '',
                'slug' => '',
                'release_date' => '2025-07-06 14:30:00',
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
