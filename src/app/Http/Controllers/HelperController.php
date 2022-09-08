<?php

namespace App\Http\Controllers;
use App\Models\NgStates;

class HelperController extends Controller
{
    public function getNgStates()
    {
        return response()->json(NgStates::all());
    }
}
