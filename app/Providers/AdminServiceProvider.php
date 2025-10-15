<?php

namespace App\Providers;

use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
    }
}
