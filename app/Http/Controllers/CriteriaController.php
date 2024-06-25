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
}
