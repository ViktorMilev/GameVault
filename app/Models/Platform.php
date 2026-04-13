<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table = 'platforms';

    protected $fillable = [
        'name',
        'slug',
        'icon_filepath',
    ];

    /**
     * Games linked to this platform (pivot: game_platforms)
     */
    public function games()
    {
        return $this->belongsToMany(
            Game::class,
            'game_platforms',
            'platform_id',
            'game_id'
        )->withTimestamps();
    }
}