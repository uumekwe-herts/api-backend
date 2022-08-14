<?php

namespace App\Http\Controllers;
use App\Models\AnonUser;
use Illuminate\Http\Request;
use JWTAuth;

class AnonymousUserAuthenticationController extends Controller
{
    public function register(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
                'question_1' => 'required',
                'answer_1' => 'required',
                'question_2' => 'required',
                'answer_2' => 'required',
                'question_3' => 'required',
                'answer_3' => 'required',
            ]);
            $auth_code = rand(10000000,99999999);
            AnonUser::create([
                'question_1' =>  $validatedData['question_1'],
                'answer_1' => $validatedData['answer_1'],
                'question_2' => $validatedData['question_2'],
                'answer_2' => $validatedData['answer_2'],
                'question_3' => $validatedData['question_3'],
                'answer_3' => $validatedData['answer_3'],
                'password' => bcrypt($auth_code),
                'username' => 'anonymous'
            ]);
            return response()->json(['auth_code' => $auth_code, 'message' => 'Anonymous User created!'], 201 );
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage() );
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username','password');
        if (!$token = auth()->guard('anon_api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token],200 );
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('anon_api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('anon_api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
