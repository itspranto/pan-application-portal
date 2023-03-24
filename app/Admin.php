<?php

namespace App;

class Admin extends Model
{
    protected static $admin_instance;

    public static function isAdmin()
    {
        return session()->has("admin_id") ? true : false;
    }

    public static function admin()
    {
        if (!self::$admin_instance) {
            self::$admin_instance = self::isAdmin() ? Admin::find(session()->get("admin_id")) : false;
        }

        return self::$admin_instance;
    }
}
