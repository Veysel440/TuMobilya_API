<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Blog Yazıları",
 *     description="Blog yazıları ile ilgili endpoint'ler"
 * )
 */
class BlogPostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/blog-posts",
     *     tags={"Blog Yazıları"},
     *     summary="Tüm blog yazılarını listele",
     *     description="Kayıtlı tüm blog yazılarını döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Blog yazıları başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Mobilya Seçiminde 5 İpucu"),
     *                 @OA\Property(property="content", type="string", example="Eviniz için doğru mobilyayı seçerken dikkat etmeniz gerekenler..."),
     *                 @OA\Property(property="image", type="string", example="blog1.jpg")
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
        $blogPosts = BlogPost::all();
        return response()->json([
            'data' => $blogPosts,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/blog-posts",
     *     tags={"Blog Yazıları"},
     *     summary="Yeni blog yazısı ekle",
     *     description="Yeni bir blog yazısı oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","content","image"},
     *             @OA\Property(property="title", type="string", example="Ev Dekorasyon Trendleri 2025"),
     *             @OA\Property(property="content", type="string", example="2025'te popüler olacak dekorasyon trendleri hakkında bilgi..."),
     *             @OA\Property(property="image", type="string", example="blog2.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Blog yazısı başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Ev Dekorasyon Trendleri 2025"),
     *                 @OA\Property(property="content", type="string", example="2025'te popüler olacak dekorasyon trendleri hakkında bilgi..."),
     *                 @OA\Property(property="image", type="string", example="blog2.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Blog yazısı oluşturuldu"),
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
    public function store(BlogPostRequest $request): JsonResponse
    {
        $blogPost = BlogPost::create($request->validated());
        return response()->json([
            'data' => $blogPost,
            'message' => 'Blog yazısı oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/blog-posts/{id}",
     *     tags={"Blog Yazıları"},
     *     summary="Tek bir blog yazısını getir",
     *     description="Belirtilen ID'ye sahip blog yazısını döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog yazısı bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Mobilya Seçiminde 5 İpucu"),
     *                 @OA\Property(property="content", type="string", example="Eviniz için doğru mobilyayı seçerken dikkat etmeniz gerekenler..."),
     *                 @OA\Property(property="image", type="string", example="blog1.jpg")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog yazısı bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(BlogPost $blogPost): JsonResponse
    {
        return response()->json([
            'data' => $blogPost,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/blog-posts/{id}",
     *     tags={"Blog Yazıları"},
     *     summary="Blog yazısı güncelle",
     *     description="Belirtilen ID'ye sahip blog yazısını günceller.",
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
     *             @OA\Property(property="title", type="string", example="Mobilya Seçiminde 5 İpucu (Güncellendi)"),
     *             @OA\Property(property="content", type="string", example="Güncellenmiş mobilya seçimi ipuçları..."),
     *             @OA\Property(property="image", type="string", example="blog1-updated.jpg")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog yazısı güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Mobilya Seçiminde 5 İpucu (Güncellendi)"),
     *                 @OA\Property(property="content", type="string", example="Güncellenmiş mobilya seçimi ipuçları..."),
     *                 @OA\Property(property="image", type="string", example="blog1-updated.jpg")
     *             ),
     *             @OA\Property(property="message", type="string", example="Blog yazısı güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog yazısı bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(BlogPostRequest $request, BlogPost $blogPost): JsonResponse
    {
        $blogPost->update($request->validated());
        return response()->json([
            'data' => $blogPost,
            'message' => 'Blog yazısı güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/blog-posts/{id}",
     *     tags={"Blog Yazıları"},
     *     summary="Blog yazısı sil",
     *     description="Belirtilen ID'ye sahip blog yazısını siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog yazısı silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Blog yazısı silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog yazısı bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(BlogPost $blogPost): JsonResponse
    {
        $blogPost->delete();
        return response()->json([
            'message' => 'Blog yazısı silindi',
            'status' => 200
        ], 200);
    }
}
