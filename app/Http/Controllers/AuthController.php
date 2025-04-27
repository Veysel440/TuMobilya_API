<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Şifre hatalı'], 401);
            }
        }


        $token = $this->getOrCreateToken($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Giriş başarısız'], 401);
        }

        $user = Auth::user();
        $token = $this->getOrCreateToken($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function getOrCreateToken($user)
    {
        $tokenModel = $user->tokens()->latest('id')->first();

        if ($tokenModel && $tokenModel->expires_at > now()) {
            return $tokenModel->token;
        }

        $user->tokens()->delete();

        $tokenResult = $user->createToken('api_token');
        $token = $tokenResult->plainTextToken;

        $user->tokens()->latest('id')->first()->update([
            'expires_at' => now()->addDay(),
        ]);

        return $token;
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Çıkış yapıldı',
        ], 200);
    }
}
