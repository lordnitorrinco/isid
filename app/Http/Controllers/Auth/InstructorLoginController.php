<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor;

class InstructorLoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $instructor = Instructor::where('email', $credentials['email'])->first();

    if ($instructor && Hash::check($credentials['password'], $instructor->password)) {
        $token = $instructor->createToken('instructor-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'instructor' => $instructor,
        ]);
    }

    return response()->json(['error' => 'Invalid credentials'], 401);
}
}
