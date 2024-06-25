<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function index()
    {
        $datas = Criteria::all();
        return view('criteria.index', compact('datas'));
    }

    public function edit($criteriaCode)
    {
        $data = Criteria::where('criteriaCode', $criteriaCode)->first();
        return view('criteria.edit', compact('data'));
    }

    public function update(Request $request, $criteriaCode)
    {
        $validateData = $request->validate([
            'criteriaWeight' => 'required'
        ]);

        // $catchData = [
        //     'criteriaCode' => $criteriaCode,

        // ];
        $result = Criteria::where('criteriaCode', $criteriaCode)->update($validateData);
        if (!$result) {
            return redirect('/criteria/edit/' . $criteriaCode . '')->with('error', 'Gagal Update data!');
        }
        return redirect('/criteria')->with('success', 'Berhasilar Update data!');

    }
}
