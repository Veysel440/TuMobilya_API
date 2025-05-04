<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Duyurular",
 *     description="Duyuru yönetimi ile ilgili endpoint'ler"
 * )
 */
class AnnouncementController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/announcements",
     *     tags={"Duyurular"},
     *     summary="Tüm duyuruları listele",
     *     description="Kayıtlı tüm duyuruları döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Duyurular başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yeni Mağaza Açılışı"),
     *                 @OA\Property(property="content", type="string", example="İstanbul'da yeni mağazamız açıldı!"),
     *                 @OA\Property(property="image", type="string", example="announcement1.jpg")
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
        $announcements = Announcement::all();
        return response()->json([
            'data' => $announcements,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/announcements",
     *     tags={"Duyurular"},
     *     summary="Yeni duyuru ekle",
     *     description="Yeni bir duyuru oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","content","image"},
     *             @OA\Property(property="title", type="string", example="Yıl Sonu İndirimi"),
     *             @OA\Property(property="content", type="string", example="Tüm ürünlerde %30 indirim fırsatı!"),
     *             @OA\Property(property="image", type="string", example="announcement2.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Duyuru başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yıl Sonu İndirimi"),
     *                 @OA\Property(property="content", type="string", example="Tüm ürünlerde %30 indirim fırsatı!"),
     *                 @OA\Property(property="image", type="string", example="announcement2.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Duyuru oluşturuldu"),
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
    public function store(AnnouncementRequest $request): JsonResponse
    {
        $announcement = Announcement::create($request->validated());
        return response()->json([
            'data' => $announcement,
            'message' => 'Duyuru oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/announcements/{id}",
     *     tags={"Duyurular"},
     *     summary="Tek bir duyuruyu getir",
     *     description="Belirtilen ID'ye sahip duyuruyu döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Duyuru bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yeni Mağaza Açılışı"),
     *                 @OA\Property(property="content", type="string", example="İstanbul'da yeni mağazamız açıldı!"),
     *                 @OA\Property(property="image", type="string", example="announcement1.jpg")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Duyuru bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(Announcement $announcement): JsonResponse
    {
        return response()->json([
            'data' => $announcement,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/announcements/{id}",
     *     tags={"Duyurular"},
     *     summary="Duyuru güncelle",
     *     description="Belirtilen ID'ye sahip duyuruyu günceller.",
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
     *             required={"title","content","image"},
     *             @OA\Property(property="title", type="string", example="Yıl Sonu İndirimi (Güncellendi)"),
     *             @OA\Property(property="content", type="string", example="Tüm ürünlerde %35 indirim fırsatı!"),
     *             @OA\Property(property="image", type="string", example="announcement2-updated.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Duyuru güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yıl Sonu İndirimi (Güncellendi)"),
     *                 @OA\Property(property="content", type="string", example="Tüm ürünlerde %35 indirim fırsatı!"),
     *                 @OA\Property(property="image", type="string", example="announcement2-updated.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Duyuru güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Duyuru bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(AnnouncementRequest $request, Announcement $announcement): JsonResponse
    {
        $announcement->update($request->validated());
        return response()->json([
            'data' => $announcement,
            'message' => 'Duyuru güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/announcements/{id}",
     *     tags={"Duyurular"},
     *     summary="Duyuru sil",
     *     description="Belirtilen ID'ye sahip duyuruyu siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Duyuru silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Duyuru silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Duyuru bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(Announcement $announcement): JsonResponse
    {
        $announcement->delete();
        return response()->json([
            'message' => 'Duyuru silindi',
            'status' => 200
        ], 200);
    }
}
