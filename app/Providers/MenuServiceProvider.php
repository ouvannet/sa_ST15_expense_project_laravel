<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('sidebar.menu', function () {
            $menu = config('sidebar');
            
            if (Auth::check() && Auth::user()->role && Auth::user()->role->name !== 'Admin') {
                $menu['menu'] = array_filter($menu['menu'], function ($item) {
                    return isset($item['is_header']) || 
                           isset($item['is_divider']) || 
                           (isset($item['text']) && in_array($item['text'], ['Dashboard', 'Report']));
                });
                $menu['menu'] = array_values($menu['menu']);
            }

            return $menu['menu'];
        });
    }
}