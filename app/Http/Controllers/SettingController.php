<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Ayarlar",
 *     description="Site ayarları ile ilgili endpoint'ler"
 * )
 */
class SettingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/settings",
     *     tags={"Ayarlar"},
     *     summary="Tüm ayarları listele",
     *     description="Kayıtlı tüm ayarları döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Ayarlar başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+90 555 123 45 67"),
     *                 @OA\Property(property="email", type="string", example="info@tumobilya.com"),
     *                 @OA\Property(property="address", type="string", example="Mobilya Sokak No:123, İstanbul, Türkiye"),
     *                 @OA\Property(property="short_address", type="string", example="İstanbul, Türkiye"),
     *                 @OA\Property(property="facebook", type="string", example="https://facebook.com/tumobilya"),
     *                 @OA\Property(property="twitter", type="string", example="https://twitter.com/tumobilya"),
     *                 @OA\Property(property="instagram", type="string", example="https://instagram.com/tumobilya"),
     *                 @OA\Property(property="youtube", type="string", example="https://youtube.com/tumobilya"),
     *                 @OA\Property(property="general_title", type="string", example="TuMobilya - Kaliteli Mobilyalar"),
     *                 @OA\Property(property="general_description", type="string", example="Evlerinize şıklık ve konfor katan mobilya çözümleri."),
     *                 @OA\Property(property="general_photo", type="string", example="logo.jpg")
     *             )
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
    public function index(): JsonResponse
    {
        $settings = Setting::all();
        return response()->json([
            'data' => $settings,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/settings",
     *     tags={"Ayarlar"},
     *     summary="Yeni ayar ekle",
     *     description="Yeni bir ayar oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="phone", type="string", example="+90 555 987 65 43"),
     *             @OA\Property(property="email", type="string", example="support@tumobilya.com"),
     *             @OA\Property(property="address", type="string", example="Yeni Sokak No:456, İstanbul, Türkiye"),
     *             @OA\Property(property="short_address", type="string", example="İstanbul, Türkiye"),
     *             @OA\Property(property="facebook", type="string", example="https://facebook.com/tumobilya2"),
     *             @OA\Property(property="twitter", type="string", example="https://twitter.com/tumobilya2"),
     *             @OA\Property(property="instagram", type="string", example="https://instagram.com/tumobilya2"),
     *             @OA\Property(property="youtube", type="string", example="https://youtube.com/tumobilya2"),
     *             @OA\Property(property="general_title", type="string", example="TuMobilya - Yeni Nesil Mobilyalar"),
     *             @OA\Property(property="general_description", type="string", example="Yeni nesil mobilya çözümleri."),
     *             @OA\Property(property="general_photo", type="string", example="logo2.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ayar başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+90 555 987 65 43"),
     *                 @OA\Property(property="email", type="string", example="support@tumobilya.com"),
     *                 @OA\Property(property="address", type="string", example="Yeni Sokak No:456, İstanbul, Türkiye"),
     *                 @OA\Property(property="short_address", type="string", example="İstanbul, Türkiye"),
     *                 @OA\Property(property="facebook", type="string", example="https://facebook.com/tumobilya2"),
     *                 @OA\Property(property="twitter", type="string", example="https://twitter.com/tumobilya2"),
     *                 @OA\Property(property="instagram", type="string", example="https://instagram.com/tumobilya2"),
     *                 @OA\Property(property="youtube", type="string", example="https://youtube.com/tumobilya2"),
     *                 @OA\Property(property="general_title", type="string", example="TuMobilya - Yeni Nesil Mobilyalar"),
     *                 @OA\Property(property="general_description", type="string", example="Yeni nesil mobilya çözümleri."),
     *                 @OA\Property(property="general_photo", type="string", example="logo2.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Ayar oluşturuldu"),
     *             @OA\Property(property="status", type="integer", example=201)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasyon hatası",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email field must be a valid email address."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(SettingRequest $request): JsonResponse
    {
        $setting = Setting::create($request->validated());
        return response()->json([
            'data' => $setting,
            'message' => 'Ayar oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/settings/{id}",
     *     tags={"Ayarlar"},
     *     summary="Tek bir ayarı getir",
     *     description="Belirtilen ID'ye sahip ayarı döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ayar bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+90 555 123 45 67"),
     *                 @OA\Property(property="email", type="string", example="info@tumobilya.com"),
     *                 @OA\Property(property="address", type="string", example="Mobilya Sokak No:123, İstanbul, Türkiye"),
     *                 @OA\Property(property="short_address", type="string", example="İstanbul, Türkiye"),
     *                 @OA\Property(property="facebook", type="string", example="https://facebook.com/tumobilya"),
     *                 @OA\Property(property="twitter", type="string", example="https://twitter.com/tumobilya"),
     *                 @OA\Property(property="instagram", type="string", example="https://instagram.com/tumobilya"),
     *                 @OA\Property(property="youtube", type="string", example="https://youtube.com/tumobilya"),
     *                 @OA\Property(property="general_title", type="string", example="TuMobilya - Kaliteli Mobilyalar"),
     *                 @OA\Property(property="general_description", type="string", example="Evlerinize şıklık ve konfor katan mobilya çözümleri."),
     *                 @OA\Property(property="general_photo", type="string", example="logo.jpg")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ayar bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(Setting $setting): JsonResponse
    {
        return response()->json([
            'data' => $setting,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/settings/{id}",
     *     tags={"Ayarlar"},
     *     summary="Ayar güncelle",
     *     description="Belirtilen ID'ye sahip ayarı günceller.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="phone", type="string", example="+90 555 987 65 43"),
     *             @OA\Property(property="email", type="string", example="support@tumobilya.com"),
     *             @OA\Property(property="address", type="string", example="Yeni Sokak No:456, İstanbul, Türkiye"),
     *             @OA\Property(property="short_address", type="string", example="İstanbul, Türkiye"),
     *             @OA\Property(property="facebook", type="string", example="https://facebook.com/tumobilya2"),
     *             @OA\Property(property="twitter", type="string", example="https://twitter.com/tumobilya2"),
     *             @OA\Property(property="instagram", type="string", example="https://instagram.com/tumobilya2"),
     *             @OA\Property(property="youtube", type="string", example="https://youtube.com/tumobilya2"),
     *             @OA\Property(property="general_title", type="string", example="TuMobilya - Yeni Nesil Mobilyalar"),
     *             @OA\Property(property="general_description", type="string", example="Yeni nesil mobilya çözümleri."),
     *             @OA\Property(property="general_photo", type="string", example="logo2.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ayar güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="phone", type="string", example="+90 555 987 65 43"),
     *                 @OA\Property(property="email", type="string", example="support@tumobilya.com"),
     *                 @OA\Property(property="address", type="string", example="Yeni Sokak No:456, İstanbul, Türkiye"),
     *                 @OA\Property(property="short_address", type="string", example="İstanbul, Türkiye"),
     *                 @OA\Property(property="facebook", type="string", example="https://facebook.com/tumobilya2"),
     *                 @OA\Property(property="twitter", type="string", example="https://twitter.com/tumobilya2"),
     *                 @OA\Property(property="instagram", type="string", example="https://instagram.com/tumobilya2"),
     *                 @OA\Property(property="youtube", type="string", example="https://youtube.com/tumobilya2"),
     *                 @OA\Property(property="general_title", type="string", example="TuMobilya - Yeni Nesil Mobilyalar"),
     *                 @OA\Property(property="general_description", type="string", example="Yeni nesil mobilya çözümleri."),
     *                 @OA\Property(property="general_photo", type="string", example="logo2.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Ayar güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ayar bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(SettingRequest $request, Setting $setting): JsonResponse
    {
        $setting->update($request->validated());
        return response()->json([
            'data' => $setting,
            'message' => 'Ayar güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/settings/{id}",
     *     tags={"Ayarlar"},
     *     summary="Ayar sil",
     *     description="Belirtilen ID'ye sahip ayarı siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ayar silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ayar silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ayar bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(Setting $setting): JsonResponse
    {
        $setting->delete();
        return response()->json([
            'message' => 'Ayar silindi',
            'status' => 200
        ], 200);
    }
}
