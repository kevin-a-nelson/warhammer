<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minature extends Model
{
    use HasFactory;

    protected $fillable = [
        'newRecruitId',
        'name',
        'from',
        'cost',
        'movement',
        'toughness',
        'armor_save',
        'wounds',
        'leadership',
        'objective_control'
    ];

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'ability_minature');
    }

    public function weapons()
    {
        return $this->belongsToMany(Weapon::class, 'minature_weapon');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_minature');
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'minature_rule');
    }
}
