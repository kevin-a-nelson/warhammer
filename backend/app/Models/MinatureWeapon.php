<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatureWeapon extends Model
{
    use HasFactory;

    protected $table = 'minature_weapon';

    protected $fillable = [
        'minature_id',
        'weapon_id',
        'board_id',
    ];  
}
