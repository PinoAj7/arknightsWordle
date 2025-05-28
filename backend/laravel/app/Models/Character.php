<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'image',
        'name',
        'faction',
        'class',
        'archetype',
        'rarity',
        'dp_cost',
    ];
}
