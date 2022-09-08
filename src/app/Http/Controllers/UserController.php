<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'phone' => 'required|max:11',
                'date_of_birth' => 'required',
                'state' => 'required',
                'gender' => 'required'
            ]);
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'phone' => $validated['phone'],
                'date_of_birth' => $validated['date_of_birth'],
                'state' => $validated['state'],
                'gender' => $validated['gender']
            ]);
            return response()->json(['user' => $user ,
                'message' => 'User created'], 201);
        }catch(\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('user_api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response([
            'message' => 'Success',
            'token' => $token
        ]);
    }

    public function profile()
    {
        return Auth::user();
    }
}
