<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Services\Interfaces\MenuServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;

/**
 * @OA\Tag(
 *     name="Menüler",
 *     description="Menü yönetimi ile ilgili endpoint'ler"
 * )
 */
class MenuController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/menus",
     *     tags={"Menüler"},
     *     summary="Tüm menüleri listele",
     *     description="Kayıtlı tüm menüleri döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Menüler başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Ana Sayfa"),
     *                 @OA\Property(property="url", type="string", example="/"),
     *                 @OA\Property(property="page_description", type="string", example="TuMobilya ana sayfası"),
     *                 @OA\Property(property="page_title", type="string", example="Hoş Geldiniz")
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
        $menus = Menu::all();
        return response()->json([
            'data' => $menus,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/menus",
     *     tags={"Menüler"},
     *     summary="Yeni menü ekle",
     *     description="Yeni bir menü oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","url"},
     *             @OA\Property(property="title", type="string", example="Hakkımızda"),
     *             @OA\Property(property="url", type="string", example="/about"),
     *             @OA\Property(property="page_description", type="string", example="TuMobilya hakkında bilgiler"),
     *             @OA\Property(property="page_title", type="string", example="Hakkımızda")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Menü başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Hakkımızda"),
     *                 @OA\Property(property="url", type="string", example="/about"),
     *                 @OA\Property(property="page_description", type="string", example="TuMobilya hakkında bilgiler"),
     *                 @OA\Property(property="page_title", type="string", example="Hakkımızda")
     *             ),
     *             @OA\Property(property="message", type="string", example="Menü oluşturuldu"),
     *             @OA\Property(property="status", type="integer", example=201)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasyon hatası",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The title field is required."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(MenuRequest $request): JsonResponse
    {
        $menu = Menu::create($request->validated());
        return response()->json([
            'data' => $menu,
            'message' => 'Menü oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/menus/{id}",
     *     tags={"Menüler"},
     *     summary="Tek bir menüyü getir",
     *     description="Belirtilen ID'ye sahip menüyü döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Menü bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Ana Sayfa"),
     *                 @OA\Property(property="url", type="string", example="/"),
     *                 @OA\Property(property="page_description", type="string", example="TuMobilya ana sayfası"),
     *                 @OA\Property(property="page_title", type="string", example="Hoş Geldiniz")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Menü bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(Menu $menu): JsonResponse
    {
        return response()->json([
            'data' => $menu,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/menus/{id}",
     *     tags={"Menüler"},
     *     summary="Menü güncelle",
     *     description="Belirtilen ID'ye sahip menüyü günceller.",
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
     *             required={"title","url"},
     *             @OA\Property(property="title", type="string", example="Hakkımızda (Güncellendi)"),
     *             @OA\Property(property="url", type="string", example="/about-updated"),
     *             @OA\Property(property="page_description", type="string", example="Güncellenmiş bilgiler"),
     *             @OA\Property(property="page_title", type="string", example="Hakkımızda Güncellendi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Menü güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Hakkımızda (Güncellendi)"),
     *                 @OA\Property(property="url", type="string", example="/about-updated"),
     *                 @OA\Property(property="page_description", type="string", example="Güncellenmiş bilgiler"),
     *                 @OA\Property(property="page_title", type="string", example="Hakkımızda Güncellendi")
     *             ),
     *             @OA\Property(property="message", type="string", example="Menü güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Menü bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(MenuRequest $request, Menu $menu): JsonResponse
    {
        $menu->update($request->validated());
        return response()->json([
            'data' => $menu,
            'message' => 'Menü güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/menus/{id}",
     *     tags={"Menüler"},
     *     summary="Menü sil",
     *     description="Belirtilen ID'ye sahip menüyü siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Menü silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Menü silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Menü bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(Menu $menu): JsonResponse
    {
        $menu->delete();
        return response()->json([
            'message' => 'Menü silindi',
            'status' => 200
        ], 200);
    }
}
