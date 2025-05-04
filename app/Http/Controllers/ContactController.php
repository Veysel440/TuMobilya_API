<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="İletişim",
 *     description="İletişim mesajları ile ilgili endpoint'ler"
 * )
 */
class ContactController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     tags={"İletişim"},
     *     summary="Tüm iletişim mesajlarını listele",
     *     description="Kayıtlı tüm iletişim mesajlarını döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="İletişim mesajları başarıyla listelendi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="first_name", type="string", example="Ahmet"),
     *                 @OA\Property(property="last_name", type="string", example="Yılmaz"),
     *                 @OA\Property(property="email", type="string", example="ahmet.yilmaz@example.com"),
     *                 @OA\Property(property="message", type="string", example="Koltuk takımı hakkında bilgi almak istiyorum.")
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
        $contacts = Contact::all();
        return response()->json([
            'data' => $contacts,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     tags={"İletişim"},
     *     summary="Yeni iletişim mesajı ekle",
     *     description="Yeni bir iletişim mesajı oluşturur.",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"first_name","last_name","email","message"},
     *             @OA\Property(property="first_name", type="string", example="Mehmet"),
     *             @OA\Property(property="last_name", type="string", example="Demir"),
     *             @OA\Property(property="email", type="string", example="mehmet.demir@example.com"),
     *             @OA\Property(property="message", type="string", example="Yeni koleksiyon hakkında bilgi almak istiyorum.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="İletişim mesajı başarıyla oluşturuldu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="first_name", type="string", example="Mehmet"),
     *                 @OA\Property(property="last_name", type="string", example="Demir"),
     *                 @OA\Property(property="email", type="string", example="mehmet.demir@example.com"),
     *                 @OA\Property(property="message", type="string", example="Yeni koleksiyon hakkında bilgi almak istiyorum.")
     *             ),
     *             @OA\Property(property="message", type="string", example="İletişim mesajı oluşturuldu"),
     *             @OA\Property(property="status", type="integer", example=201)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasyon hatası",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The first_name field is required."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = Contact::create($request->validated());
        return response()->json([
            'data' => $contact,
            'message' => 'İletişim mesajı oluşturuldu',
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     tags={"İletişim"},
     *     summary="Tek bir iletişim mesajını getir",
     *     description="Belirtilen ID'ye sahip iletişim mesajını döndürür.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="İletişim mesajı bulundu",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="first_name", type="string", example="Ahmet"),
     *                 @OA\Property(property="last_name", type="string", example="Yılmaz"),
     *                 @OA\Property(property="email", type="string", example="ahmet.yilmaz@example.com"),
     *                 @OA\Property(property="message", type="string", example="Koltuk takımı hakkında bilgi almak istiyorum.")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="İletişim mesajı bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function show(Contact $contact): JsonResponse
    {
        return response()->json([
            'data' => $contact,
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     tags={"İletişim"},
     *     summary="İletişim mesajı güncelle",
     *     description="Belirtilen ID'ye sahip iletişim mesajını günceller.",
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
     *             required={"first_name","last_name","email","message"},
     *             @OA\Property(property="first_name", type="string", example="Mehmet"),
     *             @OA\Property(property="last_name", type="string", example="Demir (Güncellendi)"),
     *             @OA\Property(property="email", type="string", example="mehmet.demir@example.com"),
     *             @OA\Property(property="message", type="string", example="Güncellenmiş mesaj.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="İletişim mesajı güncellendi",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="first_name", type="string", example="Mehmet"),
     *                 @OA\Property(property="last_name", type="string", example="Demir (Güncellendi)"),
     *                 @OA\Property(property="email", type="string", example="mehmet.demir@example.com"),
     *                 @OA\Property(property="message", type="string", example="Güncellenmiş mesaj.")
     *             ),
     *             @OA\Property(property="message", type="string", example="İletişim mesajı güncellendi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="İletişim mesajı bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function update(ContactRequest $request, Contact $contact): JsonResponse
    {
        $contact->update($request->validated());
        return response()->json([
            'data' => $contact,
            'message' => 'İletişim mesajı güncellendi',
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     tags={"İletişim"},
     *     summary="İletişim mesajı sil",
     *     description="Belirtilen ID'ye sahip iletişim mesajını siler.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="İletişim mesajı silindi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="İletişim mesajı silindi"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="İletişim mesajı bulunamadı",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Kaynak bulunamadı"),
     *             @OA\Property(property="status", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();
        return response()->json([
            'message' => 'İletişim mesajı silindi',
            'status' => 200
        ], 200);
    }
}
