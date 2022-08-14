<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnonRegQuestion;
use App\Models\AnonUser;

class AnonymousUserController extends Controller
{
    public function regQuestions()
    {
        $regQuestions = AnonRegQuestion::all();
        return response()->json($regQuestions);
    }



    public function dashboard()
    {
        return response()->json('anonymous dashboard');
    }

}
