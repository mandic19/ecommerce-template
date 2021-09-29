<?php

namespace common\helpers;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

class RbacHelper
{
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';

    const ROLES = [
        self::ROLE_SUPER_ADMIN => 'Super Admin',
        self::ROLE_ADMIN => 'Admin'
    ];

    public static function can($permission)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        if (static::isAdmin()) {
            return true;
        }
        return Yii::$app->user->can($permission);
    }

    public static function canAccessRoute($route)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $routePart = '';
        foreach (array_filter(explode('/', $route)) as $part) {
            $routePart .= "/$part";
            if (static::can($routePart)) {
                return true;
            }
        }
        return false;
    }

    public static function isAdmin()
    {
        $user = Yii::$app->user;
        return $user->can(static::ROLE_ADMIN) || $user->can(static::ROLE_ADMIN);
    }

    /**
     * @throws Exception
     */
    public static function getRoleLabel($roleName)
    {
        if (!$roleLabel = ArrayHelper::getValue(static::ROLES, $roleName)) {
            return Inflector::humanize($roleName);
        }
        return $roleLabel;
    }
}