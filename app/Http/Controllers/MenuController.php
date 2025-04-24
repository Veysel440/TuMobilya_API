<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Services\Interfaces\MenuServiceInterface;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuServiceInterface $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(): JsonResponse
    {
        $menus = $this->menuService->getAllMenus();
        return response()->json(['data' => $menus], 200);
    }

    public function show($id): JsonResponse
    {
        $menu = $this->menuService->getMenuById($id);
        return response()->json(['data' => $menu], 200);
    }

    public function store(MenuRequest $request): JsonResponse
    {
        $menu = $this->menuService->createMenu($request->validated());
        return response()->json(['data' => $menu, 'message' => 'Menü oluşturuldu'], 201);
    }

    public function update(MenuRequest $request, $id): JsonResponse
    {
        $menu = $this->menuService->updateMenu($id, $request->validated());
        return response()->json(['data' => $menu, 'message' => 'Menü güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->menuService->deleteMenu($id);
        return response()->json(['message' => 'Menü silindi'], 200);
    }
}
