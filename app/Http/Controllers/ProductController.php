<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

/**
 * @OA\Tag(
 *     name="Ürünler",
 *     description="Ürün yönetimi ile ilgili endpoint'ler"
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Ürünler"},
     *     summary="Tüm ürünleri listele",
     *     description="Kayıtlı tüm ürünleri döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Ürünler başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Modern Koltuk Takımı"),
     *                 @OA\Property(property="image", type="string", example="koltuk-takimi.jpg"),
     *                 @OA\Property(property="price", type="number", format="float", example=4999.99),
     *                 @OA\Property(property="product_details", type="string", example="Rahat ve şık bir koltuk takımı.")
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
        $products = Product::all();
        return response()->json([
            'data' => $products,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Ürünler"},
     *     summary="Yeni ürün ekle",
     *     description="Yeni bir ürün oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","price"},
     *             @OA\Property(property="name", type="string", example="Lüks Yatak Odası Takımı"),
     *             @OA\Property(property="image", type="string", example="yatak-odasi.jpg"),
     *             @OA\Property(property="price", type="number", format="float", example=7999.99),
     *             @OA\Property(property="product_details", type="string", example="Modern tasarım, beyaz lake kaplama.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ürün başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Lüks Yatak Odası Takımı"),
     *                 @OA\Property(property="image", type="string", example="yatak-odasi.jpg"),
     *                 @OA\Property(property="price", type="number", format="float", example=7999.99),
     *                 @OA\Property(property="product_details", type="string", example="Modern tasarım, beyaz lake kaplama.")
     *             ),
     *             @OA\Property(property="message", type="string", example="Ürün oluşturuldu"),
     *             @OA\Property(property="status", type="integer", example=201)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasyon hatası",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The name field is required."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());
        return response()->json([
            'data' => $product,
            'message' => 'Ürün oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Ürünler"},
     *     summary="Tek bir ürünü getir",
     *     description="Belirtilen ID'ye sahip ürünü döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ürün bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Modern Koltuk Takımı"),
     *                 @OA\Property(property="image", type="string", example="koltuk-takimi.jpg"),
     *                 @OA\Property(property="price", type="number", format="float", example=4999.99),
     *                 @OA\Property(property="product_details", type="string", example="Rahat ve şık bir koltuk takımı.")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ürün bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Ürünler"},
     *     summary="Ürün güncelle",
     *     description="Belirtilen ID'ye sahip ürünü günceller.",
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
     *             required={"name","price"},
     *             @OA\Property(property="name", type="string", example="Modern Koltuk Takımı (Güncellendi)"),
     *             @OA\Property(property="image", type="string", example="koltuk-takimi-guncel.jpg"),
     *             @OA\Property(property="price", type="number", format="float", example=5499.99),
     *             @OA\Property(property="product_details", type="string", example="Gri kumaş kaplama, ekstra konforlu.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ürün güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Modern Koltuk Takımı (Güncellendi)"),
     *                 @OA\Property(property="image", type="string", example="koltuk-takimi-guncel.jpg"),
     *                 @OA\Property(property="price", type="number", format="float", example=5499.99),
     *                 @OA\Property(property="product_details", type="string", example="Gri kumaş kaplama, ekstra konforlu.")
     *             ),
     *             @OA\Property(property="message", type="string", example="Ürün güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ürün bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());
        return response()->json([
            'data' => $product,
            'message' => 'Ürün güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Ürünler"},
     *     summary="Ürün sil",
     *     description="Belirtilen ID'ye sahip ürünü siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ürün silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ürün silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ürün bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json([
            'message' => 'Ürün silindi',
            'status' => 200
        ], 200);
    }
}
