<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\RefreshToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller {
    // Register a new user
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company_id' => 'exists:companies,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id,
            'role' => User::ROLE_USER // Assign a default role of 'user'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Login an existing user
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

//        $token = $user->createToken('auth_token')->plainTextToken;
        // Set expiration time to 1 hour from now
        $expiration = Carbon::now()->addHour();
        $token = $user->createToken('auth_token', [], $expiration);

        // Store expiration in token metadata
        $token->accessToken->expires_at = $expiration;
        $token->accessToken->save();

        $refreshToken = Str::random(64);
        $user->refreshTokens()->create(['token' => hash('sha256', $refreshToken)]);



        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'role' => $user->role,
            'expires_at' => $expiration,
            'refresh_token' => $refreshToken
        ]);
    }

    public function refresh(Request $request) {
        // Retrieve and hash the refresh token
        $refreshToken = $request->input('refresh_token');
        $hashedToken = hash('sha256', $refreshToken);

        // Find the refresh token in the database
        $refreshTokenRecord = RefreshToken::where('token', $hashedToken)->first();

        // If the refresh token is invalid, return an error
        if (!$refreshTokenRecord) {
            return response()->json(['message' => 'Invalid refresh token'], 401);
        }

        // Get the user associated with the refresh token
        $user = $refreshTokenRecord->user;

        // Generate a new access token with an expiration time (e.g., 1 hour from now)
        $expiration = Carbon::now()->addHour();
        $newAccessToken = $user->createToken('auth_token', [], $expiration);

        // Update the `expires_at` field of the new access token
        $newAccessToken->accessToken->expires_at = $expiration;
        $newAccessToken->accessToken->save();

        // Return the new access token and its expiration time
        return response()->json([
            'access_token' => $newAccessToken->plainTextToken,
            'expires_at' => $expiration
        ]);
    }
    // Logout the authenticated user
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // Get the authenticated user's information
    public function user(Request $request) {
        return response()->json($request->user());
    }


}
