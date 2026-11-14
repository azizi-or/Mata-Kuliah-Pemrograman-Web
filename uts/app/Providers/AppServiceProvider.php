<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Hak Akses Khusus Owner
        Gate::define('owner-only', function (User $user) {
            return $user->role === 'owner';
        });

        // Hak Akses Kelola Produk (Admin & Owner)
        Gate::define('admin-access', function (User $user) {
            return in_array($user->role, ['admin', 'owner']);
        });
    }
}