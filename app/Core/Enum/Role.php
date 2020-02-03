<?php

namespace BlogApi\Core\Enum;

final class Role
{
    const USER = 'user';
    const EDITOR = 'editor';
    const ADMIN = 'admin';
    const AUTHENTICATABLE = [self::ADMIN, self::EDITOR];
}