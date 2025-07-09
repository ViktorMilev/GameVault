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
            $table->string('icon_filepath');
            $table->timestamps();
        });

        DB::table('platforms')->insert([
            ['name' => 'Android', 'icon_filepath' => 'android.svg'],
            ['name' => 'iOS', 'icon_filepath' => 'ios.svg'],
            ['name' => 'macOS', 'icon_filepath' => 'macos.svg'],
            ['name' => 'Nintendo Switch', 'icon_filepath' => 'nintendo_switch.svg'],
            ['name' => 'Nintendo Switch 2', 'icon_filepath' => 'nintendo_switch_2.svg'],
            ['name' => 'OS X', 'icon_filepath' => 'os_x.svg'],
            ['name' => 'PlayStation 4', 'icon_filepath' => 'playstation_4.svg'],
            ['name' => 'PlayStation 5', 'icon_filepath' => 'playstation_5.svg'],
            ['name' => 'Windows', 'icon_filepath' => 'microsoft_windows.svg'],
            ['name' => 'Xbox One', 'icon_filepath' => 'xbox.svg'],
            ['name' => 'Xbox Series X/S', 'icon_filepath' => 'xbox_xs.svg'],
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
