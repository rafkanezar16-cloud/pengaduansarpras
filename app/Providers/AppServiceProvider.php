<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pengaturan website (nama, logo, warna) tersedia di layout & halaman login.
        View::composer(['layouts.app', 'auth.login', 'admin.laporan.print'], function ($view) {
            $view->with('web', Pengaturan::semua());
        });
    }
}
