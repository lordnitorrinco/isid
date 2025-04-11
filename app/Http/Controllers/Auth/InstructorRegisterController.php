<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Hash;

class InstructorRegisterController extends Controller
{

public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:instructors,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $instructor = Instructor::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    return response()->json([
        'message' => 'Instructor registered successfully',
        'instructor' => $instructor,
    ], 201);
}
}
