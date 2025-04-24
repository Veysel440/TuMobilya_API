<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Services\Interfaces\BlogPostServiceInterface;

class BlogPostService implements BlogPostServiceInterface
{
    public function getAllBlogPosts()
    {
        return BlogPost::all();
    }

    public function getBlogPostById($id)
    {
        return BlogPost::findOrFail($id);
    }

    public function createBlogPost(array $data)
    {
        return BlogPost::create($data);
    }

    public function updateBlogPost($id, array $data)
    {
        $blogPost = BlogPost::findOrFail($id);
        $blogPost->update($data);
        return $blogPost;
    }

    public function deleteBlogPost($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $blogPost->delete();
        return true;
    }
}
