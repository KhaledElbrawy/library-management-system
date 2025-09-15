<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Book;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
public function boot()
{
    View::composer(['admin.*'], function ($view) {
        $view->with('totalBooks', Book::count());
        $view->with('totalUsers', User::where('role', 'student')->count());
    });
}

}
