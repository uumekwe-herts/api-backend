<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function register(Request $request)
    {
        try
        {
            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $adminUser = Admin::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);
            return response()->json(['adminUser' => $adminUser ,
                'message' => 'Admin User created'], 201);
        }catch(\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('admin_api')->attempt($credentials)) {
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
