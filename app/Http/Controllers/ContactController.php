<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\Interfaces\ContactServiceInterface;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(): JsonResponse
    {
        $contacts = $this->contactService->getAllContacts();
        return response()->json(['data' => $contacts], 200);
    }

    public function show($id): JsonResponse
    {
        $contact = $this->contactService->getContactById($id);
        return response()->json(['data' => $contact], 200);
    }

    public function store(ContactRequest $request): JsonResponse
    {
        $contact = $this->contactService->createContact($request->validated());
        return response()->json(['data' => $contact, 'message' => 'İletişim oluşturuldu'], 201);
    }

    public function update(ContactRequest $request, $id): JsonResponse
    {
        $contact = $this->contactService->updateContact($id, $request->validated());
        return response()->json(['data' => $contact, 'message' => 'İletişim güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->contactService->deleteContact($id);
        return response()->json(['message' => 'İletişim silindi'], 200);
    }
}
