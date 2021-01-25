<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(json_encode(['error' => 'unable to authenticate!']), 404);
        }

        $token = $user->createToken('User Token')->accessToken;

        return response()->json(['token' => $token]);
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
