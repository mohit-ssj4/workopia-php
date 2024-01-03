<?php

namespace Framework;

class Authorization
{
    /**
     * Checks if current logged-in user owns a resource
     */
    public static function isOwner(int $resourceId): bool
    {
        $user = Session::get('user');
        if (!empty($user) && !empty($user['id'])) {
            return $resourceId === (int)$user['id'];
        }
        return false;
    }
}
