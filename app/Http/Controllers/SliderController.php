<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Services\Interfaces\SliderServiceInterface;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderServiceInterface $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    public function index(): JsonResponse
    {
        $sliders = $this->sliderService->getAllSliders();
        return response()->json(['data' => $sliders], 200);
    }

    public function show($id): JsonResponse
    {
        $slider = $this->sliderService->getSliderById($id);
        return response()->json(['data' => $slider], 200);
    }

    public function store(SliderRequest $request): JsonResponse
    {
        $slider = $this->sliderService->createSlider($request->validated());
        return response()->json(['data' => $slider, 'message' => 'Slider oluşturuldu'], 201);
    }

    public function update(SliderRequest $request, $id): JsonResponse
    {
        $slider = $this->sliderService->updateSlider($id, $request->validated());
        return response()->json(['data' => $slider, 'message' => 'Slider güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->sliderService->deleteSlider($id);
        return response()->json(['message' => 'Slider silindi'], 200);
    }
}
