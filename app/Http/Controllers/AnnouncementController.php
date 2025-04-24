<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Services\Interfaces\AnnouncementServiceInterface;
use Illuminate\Http\JsonResponse;

class AnnouncementController extends Controller
{
    protected $announcementService;

    public function __construct(AnnouncementServiceInterface $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function index(): JsonResponse
    {
        $announcements = $this->announcementService->getAllAnnouncements();
        return response()->json(['data' => $announcements], 200);
    }

    public function show($id): JsonResponse
    {
        $announcement = $this->announcementService->getAnnouncementById($id);
        return response()->json(['data' => $announcement], 200);
    }

    public function store(AnnouncementRequest $request): JsonResponse
    {
        $announcement = $this->announcementService->createAnnouncement($request->validated());
        return response()->json(['data' => $announcement, 'message' => 'Duyuru oluşturuldu'], 201);
    }

    public function update(AnnouncementRequest $request, $id): JsonResponse
    {
        $announcement = $this->announcementService->updateAnnouncement($id, $request->validated());
        return response()->json(['data' => $announcement, 'message' => 'Duyuru güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->announcementService->deleteAnnouncement($id);
        return response()->json(['message' => 'Duyuru silindi'], 200);
    }
}
