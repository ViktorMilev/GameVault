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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('categories')->insert([
            ['name' => 'Action'],
            ['name' => 'Adventure'],
            ['name' => 'Role-Playing (RPG)'],
            ['name' => 'Simulation'],
            ['name' => 'Strategy'],
            ['name' => 'Sports'],
            ['name' => 'Puzzle'],
            ['name' => 'Horror'],
            ['name' => 'Shooter'],
            ['name' => 'Racing'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
