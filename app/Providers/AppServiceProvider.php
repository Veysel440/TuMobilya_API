<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\MenuServiceInterface;
use App\Services\Interfaces\SettingServiceInterface;
use App\Services\Interfaces\ContactServiceInterface;
use App\Services\Interfaces\SliderServiceInterface;
use App\Services\Interfaces\BlogPostServiceInterface;
use App\Services\Interfaces\AnnouncementServiceInterface;
use App\Services\ProductService;
use App\Services\MenuService;
use App\Services\SettingService;
use App\Services\ContactService;
use App\Services\SliderService;
use App\Services\BlogPostService;
use App\Services\AnnouncementService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
        $this->app->singleton(MenuServiceInterface::class, MenuService::class);
        $this->app->singleton(SettingServiceInterface::class, SettingService::class);
        $this->app->singleton(ContactServiceInterface::class, ContactService::class);
        $this->app->singleton(SliderServiceInterface::class, SliderService::class);
        $this->app->singleton(BlogPostServiceInterface::class, BlogPostService::class);
        $this->app->singleton(AnnouncementServiceInterface::class, AnnouncementService::class);
    }

    public function boot(): void
    {
        //
    }
}
