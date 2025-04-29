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
            
            if (Auth::check() && Auth::user()->role) {
                $roleName = Auth::user()->role->name;

                $allowedItems = [
                    'Admin' => null, 
                    'Manager' => ['Dashboard', 'Expense', 'Category', 'People', 'Report'],
                    'Account' => ['Dashboard', 'Expense','Recurring Report', 'Report'],
                    'Staff' => ['Dashboard','Report'],
                ];

          
                if ($roleName !== 'Admin') {
                    $menu['menu'] = array_filter($menu['menu'], function ($item) use ($allowedItems, $roleName) {
                        return isset($item['is_header']) || 
                               isset($item['is_divider']) || 
                               (isset($item['text']) && in_array($item['text'], $allowedItems[$roleName]));
                    });
                    $menu['menu'] = array_values($menu['menu']);
                }
            }

            return $menu['menu'];
        });
    }
}