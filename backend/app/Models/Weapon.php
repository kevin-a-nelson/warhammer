<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'newRecruitId',
        'name',
        'typeId',
        'typeName',
        'from',
        'range',
        'attack',
        'combat_skill',
        'strength',
        'armor_penetration',
        'damage'
    ];
}
