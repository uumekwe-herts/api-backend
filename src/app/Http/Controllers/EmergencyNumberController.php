<?php

namespace App\Http\Controllers;
use App\Models\EmergencyNumber;
use Illuminate\Http\Request;

class EmergencyNumberController extends Controller
{
    public function addEmergencyNumber(Request $request)
    {
        $validated = $request->validate([
            'agency' => 'required',
            'phone_numbers' => 'required'
        ]);

        $number = EmergencyNumber::create([
            'agency' => $validated['agency'],
            'phone_numbers' => $validated['phone_numbers']
        ]);
        return response()->json(['number' => $number]);
    }

    public function list(Request $request)
    {
        $emergencyNumbers = EmergencyNumber::all();
        return response()->json(['numbers' => $emergencyNumbers]);
    }

    public function edit(Request $request)
    {
        try
        {
            $id = $request->input('id');
            $number = EmergencyNumber::find($id);
            $validated = $request->validate([
                'agency' => 'required',
                'phone_numbers' => 'required'
            ]);
            $number->agency = $validated['agency'];
            $number->phone_numbers = $validated['phone_numbers'];
            $number->save();
            return response()->json([
                'number' => $number
            ]);
        } catch(\Exception $ex)
        {
            return response()->json($ex->getMessage());
        }
    }

    public function getNumber($id)
    {
        try {
            $number = EmergencyNumber::find($id);
            return response()->json([
                'number' => $number
            ]);
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }
}
