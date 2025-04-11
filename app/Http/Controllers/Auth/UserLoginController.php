<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserLoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $credentials['email'])->first();
    
        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('user-token')->plainTextToken;
    
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }
    
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
