<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->getAllProducts();
        return response()->json(['data' => $products], 200);
    }

    public function show($id): JsonResponse
    {
        $product = $this->productService->getProductById($id);
        return response()->json(['data' => $product], 200);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->productService->createProduct($request->validated());
        return response()->json(['data' => $product, 'message' => 'Ürün oluşturuldu'], 201);
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        $product = $this->productService->updateProduct($id, $request->validated());
        return response()->json(['data' => $product, 'message' => 'Ürün güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Ürün silindi'], 200);
    }
}
