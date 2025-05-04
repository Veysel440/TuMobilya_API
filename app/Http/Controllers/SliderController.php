<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Slaytlar",
 *     description="Slayt yönetimi ile ilgili endpoint'ler"
 * )
 */
class SliderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/sliders",
     *     tags={"Slaytlar"},
     *     summary="Tüm slaytları listele",
     *     description="Kayıtlı tüm slaytları döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Slaytlar başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yeni Koleksiyon"),
     *                 @OA\Property(property="description", type="string", example="2025 mobilya koleksiyonumuzu keşfedin!"),
     *                 @OA\Property(property="image", type="string", example="slider1.jpg")
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
        $sliders = Slider::all();
        return response()->json([
            'data' => $sliders,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/sliders",
     *     tags={"Slaytlar"},
     *     summary="Yeni slayt ekle",
     *     description="Yeni bir slayt oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","image"},
     *             @OA\Property(property="title", type="string", example="Yaz İndirimi"),
     *             @OA\Property(property="description", type="string", example="Tüm ürünlerde %20 indirim!"),
     *             @OA\Property(property="image", type="string", example="slider3.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Slayt başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yaz İndirimi"),
     *                 @OA\Property(property="description", type="string", example="Tüm ürünlerde %20 indirim!"),
     *                 @OA\Property(property="image", type="string", example="slider3.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Slayt oluşturuldu"),
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
    public function store(SliderRequest $request): JsonResponse
    {
        $slider = Slider::create($request->validated());
        return response()->json([
            'data' => $slider,
            'message' => 'Slayt oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/sliders/{id}",
     *     tags={"Slaytlar"},
     *     summary="Tek bir slaytı getir",
     *     description="Belirtilen ID'ye sahip slaytı döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Slayt bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yeni Koleksiyon"),
     *                 @OA\Property(property="description", type="string", example="2025 mobilya koleksiyonumuzu keşfedin!"),
     *                 @OA\Property(property="image", type="string", example="slider1.jpg")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slayt bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(Slider $slider): JsonResponse
    {
        return response()->json([
            'data' => $slider,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/sliders/{id}",
     *     tags={"Slaytlar"},
     *     summary="Slayt güncelle",
     *     description="Belirtilen ID'ye sahip slaytı günceller.",
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
     *             required={"title","image"},
     *             @OA\Property(property="title", type="string", example="Yaz İndirimi (Güncellendi)"),
     *             @OA\Property(property="description", type="string", example="Tüm ürünlerde %25 indirim!"),
     *             @OA\Property(property="image", type="string", example="slider3-updated.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Slayt güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Yaz İndirimi (Güncellendi)"),
     *                 @OA\Property(property="description", type="string", example="Tüm ürünlerde %25 indirim!"),
     *                 @OA\Property(property="image", type="string", example="slider3-updated.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Slayt güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slayt bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(SliderRequest $request, Slider $slider): JsonResponse
    {
        $slider->update($request->validated());
        return response()->json([
            'data' => $slider,
            'message' => 'Slayt güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/sliders/{id}",
     *     tags={"Slaytlar"},
     *     summary="Slayt sil",
     *     description="Belirtilen ID'ye sahip slaytı siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Slayt silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Slayt silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slayt bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(Slider $slider): JsonResponse
    {
        $slider->delete();
        return response()->json([
            'message' => 'Slayt silindi',
            'status' => 200
        ], 200);
    }
}
