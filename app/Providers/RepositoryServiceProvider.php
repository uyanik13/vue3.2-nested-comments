<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\Comment\CommentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
     }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
