<?php

namespace App\Http\Controllers;

use App\Models\CaseAttachment;
use Illuminate\Http\Request;
use App\Models\AnonRegQuestion;
use App\Models\AnonUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnonymousUserController extends Controller
{
    public function regQuestions()
    {
        $regQuestions = AnonRegQuestion::all();
        return response()->json($regQuestions);
    }

    public function profile()
    {
        return response()->json(auth('anon_api')->user());
    }


    public function getUserCase($user, $case_id) {
        try {
            $userRecord = DB::collection('anonymous_users')
               ->where('email', $user)
                ->get()->first();

            return $userRecord.cases[0];
               // ->where('cases', (['case_id', $case_id ]))->first();
               // db.collection.find({"aliases":{$elemMatch:{"$in":["Kelly D Benavides"], "$exists":true}}})
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }

}
