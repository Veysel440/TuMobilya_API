<?php

namespace App\Services\Interfaces;

interface BlogPostServiceInterface
{
    public function getAllBlogPosts();
    public function getBlogPostById($id);
    public function createBlogPost(array $data);
    public function updateBlogPost($id, array $data);
    public function deleteBlogPost($id);
}
