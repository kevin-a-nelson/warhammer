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

    public function minatures()
    {
        return $this->belongsToMany(Minature::class, 'minature_weapon');
    }
}
