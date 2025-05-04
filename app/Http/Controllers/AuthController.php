<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(
 *     title="TuMobilya-API",
 *     version="1.0.0",
 *     description="TuMobilya-API için kimlik doğrulama ve mobilya yönetimi API'si",
 *     @OA\Contact(
 *         email="info@tumobilya.com"
 *     )
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Yerel geliştirme sunucusu"
 * )
 * @OA\Tag(
 *     name="Kimlik Doğrulama",
 *     description="Kullanıcı kimlik doğrulama işlemleri"
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Kimlik Doğrulama"},
     *     summary="Yeni kullanıcı kaydı",
     *     description="Yeni bir kullanıcı kaydeder ve bir API token döndürür.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Yeni Kullanıcı"),
     *             @OA\Property(property="email", type="string", format="email", example="yeni@tumobilya.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Kullanıcı başarıyla kaydedildi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Yeni Kullanıcı"),
     *                     @OA\Property(property="email", type="string", example="yeni@tumobilya.com")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="1|random-token-string")
     *             ),
     *             @OA\Property(property="message", type="string", example="Kullanıcı başarıyla kaydedildi"),
     *             @OA\Property(property="status", type="integer", example=201)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasyon hatası",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email has already been taken."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email has already been taken."))
     *             ),
     *             @OA\Property(property="status", type="integer", example=422)
     *         )
     *     )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
            'message' => 'Kullanıcı başarıyla kaydedildi',
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Kimlik Doğrulama"},
     *     summary="Kullanıcı girişi",
     *     description="Kullanıcıyı doğrular ve bir API token döndürür.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@tumobilya.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Giriş başarılı",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Admin Kullanıcı"),
     *                     @OA\Property(property="email", type="string", example="admin@tumobilya.com")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="1|another-random-token-string")
     *             ),
     *             @OA\Property(property="message", type="string", example="Giriş başarılı"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Geçersiz kimlik bilgileri",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Geçersiz kimlik bilgileri"),
     *             @OA\Property(property="status", type="integer", example=401)
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'error' => 'Geçersiz kimlik bilgileri',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
            'message' => 'Giriş başarılı',
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Kimlik Doğrulama"},
     *     summary="Kullanıcı çıkışı",
     *     description="Kullanıcının mevcut tokenlarını siler ve oturumu kapatır.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Çıkış yapıldı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Çıkış yapıldı"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Kimlik doğrulanmadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated"),
     *             @OA\Property(property="status", type="integer", example=401)
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Çıkış yapıldı',
        ], 200);
    }
}
