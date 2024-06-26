<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Criteria;
use Illuminate\Http\Request;

class SAWController extends Controller
{
    public function index()
{
    // Ambil semua makanan dan kriteria dari database
    $foods = Food::all();
    $criterias = Criteria::all();

    // Hitung nilai normalisasi
    $normalizedMatrix = $this->calculateNormalizedMatrix($foods, $criterias);

    // Hitung nilai preferensi (Vi)
    $weightedSum = $this->calculateWeightedSum($normalizedMatrix, $criterias);

    // Mendapatkan ranking alternatif berdasarkan nilai preferensi tertinggi
    $rankedFoods = $this->rankFoodsByWeightedSum($weightedSum, $foods);

    // Tampilkan halaman dengan tabel yang menampilkan alternatif dan kriteria
    return view('saw.result', [
        'foods' => $foods,
        'criterias' => $criterias,
        'rankedFoods' => $rankedFoods,
        'weightedSum' => $weightedSum,
    ]);
}

    public function calculateSAW()
    {
        // Ambil semua makanan dan kriteria dari database
        $foods = Food::all();
        $criterias = Criteria::all();

        // Hitung nilai normalisasi
        $normalizedMatrix = $this->calculateNormalizedMatrix($foods, $criterias);

        // Hitung nilai preferensi (Vi)
        $weightedSum = $this->calculateWeightedSum($normalizedMatrix, $criterias);

        // Mendapatkan ranking alternatif berdasarkan nilai preferensi tertinggi
        $rankedFoods = $this->rankFoodsByWeightedSum($weightedSum, $foods);

        // Output hasil ranking
        return view('saw.result', [
            'rankedFoods' => $rankedFoods,
            'weightedSum' => $weightedSum,
        ]);
    }

    private function calculateNormalizedMatrix($foods, $criterias)
    {
        $normalizedMatrix = [];

        foreach ($foods as $food) {
            $row = [];
            foreach ($criterias as $criteria) {
                $value = $food->{'food' . ucfirst($criteria->criteriaCode) . 'Rating'};

                if ($criteria->criteriaType == 'benefit') {
                    $maxValue = $this->getMaxAttributeValue($foods, $criteria->criteriaCode);
                    $row[$criteria->criteriaCode] = $value / $maxValue;
                } else {
                    $minValue = $this->getMinAttributeValue($foods, $criteria->criteriaCode);
                    $row[$criteria->criteriaCode] = $minValue / $value;
                }
            }
            $normalizedMatrix[] = $row;
        }

        return $normalizedMatrix;
    }

    private function calculateWeightedSum($normalizedMatrix, $criterias)
    {
        $weightedSum = [];

        foreach ($normalizedMatrix as $row) {
            $sum = 0;
            foreach ($criterias as $criteria) {
                $sum += $row[$criteria->criteriaCode] * $criteria->criteriaWeight;
            }
            $weightedSum[] = $sum;
        }

        return $weightedSum;
    }

    private function rankFoodsByWeightedSum($weightedSum, $foods)
    {
        // Mendapatkan indeks urutan berdasarkan nilai preferensi tertinggi
        $rankedIndices = $this->argsort($weightedSum, true);

        // Mengurutkan makanan berdasarkan indeks yang sudah diurutkan
        $rankedFoods = [];
        foreach ($rankedIndices as $index) {
            $rankedFoods[] = $foods[$index];
        }

        return $rankedFoods;
    }

    private function getAttributeValue($food, $criteriaCode)
    {
        switch ($criteriaCode) {
            case 'taste':
                return $food->foodTasteRating;
            case 'risk':
                return $food->foodRiskRating;
            case 'age':
                return $food->foodAgeRating;
            case 'price':
                return $food->foodPriceRating;
            case 'distance':
                return $food->foodDistanceRating;
            default:
                return 0;
        }
    }

    private function getMaxAttributeValue($foods, $criteriaCode)
    {
        $max = -INF;
        foreach ($foods as $food) {
            $value = $this->getAttributeValue($food, $criteriaCode);
            if ($value > $max) {
                $max = $value;
            }
        }
        return $max;
    }

    private function getMinAttributeValue($foods, $criteriaCode)
    {
        $min = INF;
        foreach ($foods as $food) {
            $value = $this->getAttributeValue($food, $criteriaCode);
            if ($value < $min) {
                $min = $value;
            }
        }
        return $min;
    }

    private function argsort($values, $reverse = false)
    {
        $indices = range(0, count($values) - 1);
        if ($reverse) {
            array_multisort($values, SORT_DESC, $indices);
        } else {
            array_multisort($values, SORT_ASC, $indices);
        }
        return $indices;
    }
}
