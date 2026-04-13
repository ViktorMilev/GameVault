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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('icon_filepath');
            $table->timestamps();
        });

        DB::table('platforms')->insert([
            ['name' => 'Android', 'slug' => 'android', 'icon_filepath' => 'android.svg'],
            ['name' => 'iOS', 'slug' => 'ios', 'icon_filepath' => 'apple_ios.svg'],
            ['name' => 'macOS', 'slug' => 'macos', 'icon_filepath' => 'apple_macos.svg'],
            ['name' => 'Nintendo Switch', 'slug' => 'nintendo-switch', 'icon_filepath' => 'nintendo_switch.svg'],
            ['name' => 'Nintendo Switch 2', 'slug' => 'nintendo-switch-2', 'icon_filepath' => 'nintendo_switch_2.svg'],
            ['name' => 'OS X', 'slug' => 'os-x', 'icon_filepath' => 'apple_macos.svg'],
            ['name' => 'PlayStation 4', 'slug' => 'playstation-4', 'icon_filepath' => 'playstation_4.svg'],
            ['name' => 'PlayStation 5', 'slug' => 'playstation-5', 'icon_filepath' => 'playstation_5.svg'],
            ['name' => 'Windows', 'slug' => 'windows', 'icon_filepath' => 'windows.svg'],
            ['name' => 'Xbox One', 'slug' => 'xbox-one', 'icon_filepath' => 'xbox_one.svg'],
            ['name' => 'Xbox Series X/S', 'slug' => 'xbox-series-x-s', 'icon_filepath' => 'xbox_series_x_s.svg'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
