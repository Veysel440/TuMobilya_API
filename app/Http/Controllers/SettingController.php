<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Services\Interfaces\SettingServiceInterface;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(): JsonResponse
    {
        $settings = $this->settingService->getAllSettings();
        return response()->json(['data' => $settings], 200);
    }

    public function show($id): JsonResponse
    {
        $setting = $this->settingService->getSettingById($id);
        return response()->json(['data' => $setting], 200);
    }

    public function store(SettingRequest $request): JsonResponse
    {
        $setting = $this->settingService->createSetting($request->validated());
        return response()->json(['data' => $setting, 'message' => 'Ayar oluşturuldu'], 201);
    }

    public function update(SettingRequest $request, $id): JsonResponse
    {
        $setting = $this->settingService->updateSetting($id, $request->validated());
        return response()->json(['data' => $setting, 'message' => 'Ayar güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->settingService->deleteSetting($id);
        return response()->json(['message' => 'Ayar silindi'], 200);
    }
}
