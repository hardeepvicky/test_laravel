<?php
namespace App\Helpers;

class Menu
{
    private static $menu = [];
    private static $current_route_name = "";
    public static function get()
    {
        //$current_url = strtolower(request()->path());
        //self::$current_url = strtolower("Users/index");

        self::_home();

        

        return self::$menu;
    }

    
    private static function addLink(String $route_name, String $title, String $icon)
    {
        $arr = [
            "title" => $title,
            "icon" => $icon,
            "route_name" => trim($route_name)
        ];

        $arr['is_active'] = strtolower($arr['route_name']) == self::$current_route_name;

        return $arr;
    }

    private static function getControllerLinks(String $routePrefix, String $title, String $icon)
    {
        $links = [
            "title" => $title,
            "icon" => $icon,
            "links" => [
                self::addLink($routePrefix . ".index", "Summary", FontAwesomeIcon::SUMMARY),
                self::addLink($routePrefix . ".create", "Add", FontAwesomeIcon::ADD),
            ],
        ];

        return $links;
    }

    private static function _home()
    {
        $links = [];
        $routePrefix = "users";
        $links[] = self::getControllerLinks($routePrefix, "Users", "fas fa-users");
        $links[] = self::getControllerLinks("roles", "Roles", "fas fa-table");

        self::$menu['home'] = [
            'title' => 'Home',
            'icon' => 'fas fa-home',
            'links' => $links,
        ];
    }
}