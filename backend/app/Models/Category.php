<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'newRecruitId',
        'name',
        'primary'
    ];

    public function minatures()
    {
        return $this->belongsToMany(Minature::class, 'category_minature');
    }
}
