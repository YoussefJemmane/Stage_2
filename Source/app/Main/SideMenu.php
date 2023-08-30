<?php
namespace App\Main;

use Illuminate\Support\Facades\Auth;

class SideMenu
{
    /**
     * List of side menu items.
     */
    public static function menu(): array
    {
        $menu = [];

        if (Auth::check() && Auth::user()->poste == "CEO") {
            $menu['Dashboard'] = [
                'icon' => 'home',
                'title' => 'Dashboard',
                'route_name' => 'dashboard',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ];
            $menu['Employees'] = [
                'icon' => 'users',
                'title' => 'List Des Employees',
                'route_name' => 'employees.liste',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ];
        }

        $menu['List Des Frais'] = [
            'icon' => 'activity',
            'title' => 'List des Frais',
            'route_name' => 'frais.liste',
            'params' => [
                'layout' => 'side-menu'
            ],
        ];

        return $menu;
    }
}
