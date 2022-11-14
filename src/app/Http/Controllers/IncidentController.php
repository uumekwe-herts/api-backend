<?php

namespace App\Http\Controllers;

use App\Models\CaseAttachment;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IncidentController extends Controller
{
    public function submitCase(Request $request)
    {
            $validated = $request->validate([
                'reporting_for' => 'required',
                'contact_phone' => 'required',
                'age' => 'required',
                'case_details' => 'required',
                'incident_address' => 'required',
                'number_of_victims' =>  'required',
                'number_of_violators' => 'required',
                'date_of_incident' => 'required',
                'reporter_type' => 'required',
                'user_id' => 'required',
                'category' => 'required',
            ]);

            $contact_first_name = !empty($request->input('contact_first_name')) ?
                                    $request->input('contact_first_name') : "";
            $contact_last_name = !empty($request->input('contact_last_name')) ?
                                $request->input('contact_last_name') : "";
            $contact_email = !empty($request->input('contact_email')) ?
            $request->input('contact_email') : "";

            $incident = Incident::create([
                'user_id' => $validated['user_id'],
                'reporter_type' => $validated['reporter_type'],
                'reporting_for' => $validated['reporting_for'],
                'contact_phone' => $validated['contact_phone'],
                'category' => $validated['category'],
                'contact_first_name' => $contact_first_name,
                'contact_last_name' => $contact_last_name,
                'contact_email' => $contact_email,
                'age' => $validated['age'],
                'case_details' => $validated['case_details'],
                'incident_address' => $validated['incident_address'],
                'number_of_victims' => $validated['number_of_victims'],
                'number_of_violators' => $validated['number_of_violators'],
                'date_of_incident'  => $validated['date_of_incident'],
            ]);

            if($request->file('attachment')){
                foreach($request->file('attachment') as $attachment)
                {
                    $filename = $incident->id.Str::random(32).".".$attachment->getClientOriginalExtension();
                    $filepath = $attachment->move(public_path('uploads/'),$filename);
                    CaseAttachment::create([
                        'file_name' => $filename,
//                        'file_path' => $filepath,
                        'case_id' => $incident->id,
                    ]);
                }
            }
            return response()->json(['message' => 'success']);

    }

    public function getCases()
    {
        try {
            return Incident::all();
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage());
        }
    }

    public function getUserCases(int $user_id, string $user_type){
        try {
            return Incident::where('user_id', $user_id)
                    ->where('reporter_type',$user_type)->get();
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }

    public function getCase(int $case_id) {
        try{
            $case = Incident::where('id',$case_id)->get()->first();
            $attachments = $case->attachments;
            return response()->json([
                'case' => $case, 'attachments' => $attachments
            ]);
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }

    public function downloadAttachment(string $filename) {
        return response()->download(public_path('uploads/'.$filename),$filename);
    }

    public function updateStatus(Request $request) {
        try {
            $id = $request->input('case_id');
            $status = $request->input('status');
            $incident = Incident::find($id);
            $incident->status = $status;
            $incident->save();
            return response()->json([
                'incident' => $incident
            ]);
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage());
        }

    }
}
