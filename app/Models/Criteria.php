<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criterias';

    protected $fillable = [
        'criteriaCode',
        'criteriaName',
        'criteriaDesc',
        'criteriaWeight',
        'criteriaType'
    ];
    public function foods()
    {
        return $this->hasMany(Food::class, 'criteriaCode', 'criteriaCode');
    }
}
