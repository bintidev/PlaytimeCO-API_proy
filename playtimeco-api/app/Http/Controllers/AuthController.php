<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

/**
 * Authentication controller for PlaytimeCos's system access
 */
class AuthController extends Controller
{

    /**
     * Validates data collected from registration form, ensuring
     * there is no duplicated data before creating a new user
     * 
     * @param Request $request - request method
     * @return int $status - status response
     */
    public function users()
    {

        $user = User::all(); // user creation attempt

        return response()->json(['users' => $user], 201); // user and associated token

    }
    /**
     * Validates data collected from registration form, ensuring
     * there is no duplicated data before creating a new user
     * 
     * @param Request $request - request method
     * @return int $status - status response
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']); // password encryption

        $user = User::create($validated); // user creation attempt
        $token = $user->createToken('employee-token')->plainTextToken; // plain text token creation

        return response()->json(['users' => $user, 'token' => $token], 201); // user and associated token
    }

    /**
     * User authentication, validating data fetched from request
     * consulting stored users info in the system
     * 
     * @param Request $request
     * @return int $status
     */
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first(); // searchs for the first user where email
                                                                // value field matches with the one received

        if (! $user || ! Hash::check($request->password, $user->password)) { // checks if received passwords hash matches with the stored one
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'], // throws exception
            ]);
        }

        $token = $user->createToken('employee-token')->plainTextToken; // plain text token creation

        return response()->json(['user' => $user, 'token' => $token], 200); // user and associated token
    }

    /**
     * Token deletion
     * 
     * @param Request $request
     * @return int $status
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // token deletion

        return response()->json(['message' => 'Logged out successfully']);
    }
}
