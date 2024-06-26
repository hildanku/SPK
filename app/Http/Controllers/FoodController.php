<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Criteria;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index()
    {
        return view('food.index', [
            'datas' => Food::all()
        ]);
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foodName' => 'required',
            'foodDesc' => 'required',
            'foodTasteRating' => 'required',
            'foodRiskRating' => 'required',
            'foodAgeRating' => 'required',
            'foodPriceRating' => 'required',
            'foodDistanceRating' => 'required',
        ]);
        Food::create($request->all());
        return redirect('/foods');
    }
    public function edit($foodId)
    {
        $data = Food::where('foodId', $foodId)->first();
        return view('food.edit', compact('data'));
    }

    public function update(Request $request, $foodId)
    {
        $validateData = $request->validate([
            'foodName' => 'required',
            'foodDesc' => 'required',
            'foodTasteRating' => 'required|numeric',
            'foodRiskRating' => 'required|numeric',
            'foodAgeRating' => 'required|numeric',
            'foodPriceRating' => 'required|numeric',
            'foodDistanceRating' => 'required|numeric',
        ]);

        $result = Food::where('foodId', $foodId)->update($validateData);
        if (!$result) {
            return redirect('/food/edit/' . $foodId . '')->with('error', 'Gagal Update data!');
        }
        return redirect('/foods')->with('success', 'Berhasilar Update data!');
    }
    public function destroy($foodId)
    {
        $result = Food::where('foodId', $foodId)->delete();
        if (!$result) {
            return redirect('/food')->with('error', 'Gagal Hapus data!');
        }
        return redirect('/foods')->with('success', 'Berhasilar Hapus data!');
    }
    public function calculateSAWWithFakeData()
    {
        // 1. Buat data makanan (foods) dan kriteria (criterias) buatan
        $foods = [
            [
                'foodId' => 1,
                'foodName' => 'Food A',
                'foodTasteRating' => 7.0,
                'foodRiskDiseaseRating' => 2.0,
                'foodAgeSuitability' => 6.0,
                'foodPrice' => 8.0,
                'foodDistance' => 4.0
            ],
            [
                'foodId' => 2,
                'foodName' => 'Food B',
                'foodTasteRating' => 6.0,
                'foodRiskDiseaseRating' => 5.0,
                'foodAgeSuitability' => 7.5,
                'foodPrice' => 6.0,
                'foodDistance' => 5.0
            ],
            [
                'foodId' => 3,
                'foodName' => 'Food C',
                'foodTasteRating' => 8.0,
                'foodRiskDiseaseRating' => 3.0,
                'foodAgeSuitability' => 4.0,
                'foodPrice' => 7.0,
                'foodDistance' => 3.0
            ]
        ];
    
        $criterias = [
            [
                'criteriaCode' => 'taste',
                'criteriaWeight' => 30,
                'criteriaType' => 'benefit'
            ],
            [
                'criteriaCode' => 'risk',
                'criteriaWeight' => 20,
                'criteriaType' => 'cost'
            ],
            [
                'criteriaCode' => 'age',
                'criteriaWeight' => 25,
                'criteriaType' => 'benefit'
            ],
            [
                'criteriaCode' => 'price',
                'criteriaWeight' => 15,
                'criteriaType' => 'cost'
            ],
            [
                'criteriaCode' => 'distance',
                'criteriaWeight' => 10,
                'criteriaType' => 'cost'
            ]
        ];
    
        // 2. Prepare data structures
        $normalizedMatrix = []; // To store normalized values
        $wi = []; // To store criteria weights
    
        // Extract criteria weights
        foreach ($criterias as $criteria) {
            $wi[$criteria['criteriaCode']] = $criteria['criteriaWeight'] / 10; // Assuming weights are stored as percentages
        }
    
        // Normalize the decision matrix
        foreach ($foods as $food) {
            $normalizedRow = [];
            foreach ($criterias as $criteria) {
                $criteriaCode = $criteria['criteriaCode'];
    
                // Mapping criteria codes to actual column names in the foods array
                switch ($criteriaCode) {
                    case 'taste':
                        $columnName = 'foodTasteRating';
                        break;
                    case 'risk':
                        $columnName = 'foodRiskDiseaseRating';
                        break;
                    case 'age':
                        $columnName = 'foodAgeSuitability';
                        break;
                    case 'price':
                        $columnName = 'foodPrice';
                        break;
                    case 'distance':
                        $columnName = 'foodDistance';
                        break;
                    default:
                        continue 2;
                }
    
                $values = array_column($foods, $columnName);
                $maxVal = max($values);
                $minVal = min($values);
    
                if ($criteria['criteriaType'] == 'benefit') {
                    $normalizedRow[$criteriaCode] = $food[$columnName] / $maxVal;
                } else { // Cost criteria
                    $normalizedRow[$criteriaCode] = $minVal / $food[$columnName];
                }
            }
            $normalizedMatrix[$food['foodId']] = $normalizedRow;
        }
    
        // Debugging: Output normalized matrix
        var_dump($normalizedMatrix);
    
        // Calculate SAW score for each food
        $sawScores = [];
        foreach ($foods as $food) {
            $totalScore = 0;
            foreach ($criterias as $criteria) {
                $criteriaCode = $criteria['criteriaCode'];
                // Check if the key exists in both arrays
                if (isset($normalizedMatrix[$food['foodId']][$criteriaCode]) && isset($wi[$criteriaCode])) {
                    $totalScore += $normalizedMatrix[$food['foodId']][$criteriaCode] * $wi[$criteriaCode];
                } else {
                    // Debugging: Output missing keys
                    var_dump('Missing key:', $criteriaCode, $normalizedMatrix[$food['foodId']], $wi);
                }
            }
            $sawScores[$food['foodId']] = $totalScore;
        }
    
        // Debugging: Output SAW scores
        var_dump($sawScores);
    
        // Sort foods based on SAW scores (descending)
        arsort($sawScores);
    
        // Return SAW scores
        return response()->json(['scores' => $sawScores]);
    }

}
       