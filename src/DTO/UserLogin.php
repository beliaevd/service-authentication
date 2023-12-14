<?php

namespace fixsickcoder\ServiceAuthentication\DTO;

use fixsickcoder\JsonRpc\Valinor;

/**
 * DTO для аутентификации пользователя
 */
class UserLogin extends Valinor
{
    /** @var string $login Логин пользователя */
    public string $login;

    /** @var string $password Пароль пользователя */
    public string $password;
}