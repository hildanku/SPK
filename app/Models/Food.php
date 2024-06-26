<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'foodName',
        'foodDesc',
        'foodTasteRating',
        'foodRiskRating',
        'foodAgeRating',
        'foodPriceRating',
        'foodDistanceRating',
    ];
    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteriaCode', 'criteriaCode');
    }
}
