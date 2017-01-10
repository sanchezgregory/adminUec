<?php
/**
 * Created by PhpStorm.
 * User: gregory
 * Date: 1/9/17
 * Time: 6:15 PM
 */

namespace App;


class AccessHandler
{
    protected static $level = [
        'admin'     => '3',
        'editor'    => '2',
        'user'      => '1'
    ];

    public static function check($userRole, $requiredRole)
    {
        return static::$level[$userRole] >= static::$level[$requiredRole];
    }
}