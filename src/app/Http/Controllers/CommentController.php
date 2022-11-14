<?php

namespace App\Http\Controllers;
use App\Models\Incident;
use App\Models\IncidentComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function submitComment(Request $request)
    {
        $validated = $request->validate([
           'case_id' => 'required',
           'comments' => 'required'
        ]);

        $incident = IncidentComment::create([
            'case_id' => $validated['case_id'],
            'comments' => $validated['comments']
        ]);

        return response()->json(['message' => $incident]);
    }

    public function getCaseComments( $case_id) {
       try {
           $case = Incident::where('id',$case_id)->get()->first();
           $comments = $case->comments;
           return response()->json([
               'comments' => $comments
           ]);
       } catch(\Exception $ex) {
           return response()->json($ex->getMessage());
       }

    }

}
