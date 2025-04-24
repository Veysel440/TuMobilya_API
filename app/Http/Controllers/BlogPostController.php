<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Services\Interfaces\BlogPostServiceInterface;
use Illuminate\Http\JsonResponse;

class BlogPostController extends Controller
{
    protected $blogPostService;

    public function __construct(BlogPostServiceInterface $blogPostService)
    {
        $this->blogPostService = $blogPostService;
    }

    public function index(): JsonResponse
    {
        $blogPosts = $this->blogPostService->getAllBlogPosts();
        return response()->json(['data' => $blogPosts], 200);
    }

    public function show($id): JsonResponse
    {
        $blogPost = $this->blogPostService->getBlogPostById($id);
        return response()->json(['data' => $blogPost], 200);
    }

    public function store(BlogPostRequest $request): JsonResponse
    {
        $blogPost = $this->blogPostService->createBlogPost($request->validated());
        return response()->json(['data' => $blogPost, 'message' => 'Blog yazısı oluşturuldu'], 201);
    }

    public function update(BlogPostRequest $request, $id): JsonResponse
    {
        $blogPost = $this->blogPostService->updateBlogPost($id, $request->validated());
        return response()->json(['data' => $blogPost, 'message' => 'Blog yazısı güncellendi'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->blogPostService->deleteBlogPost($id);
        return response()->json(['message' => 'Blog yazısı silindi'], 200);
    }
}
