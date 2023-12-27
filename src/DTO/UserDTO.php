<?php

namespace fixsickcoder\ServiceAuthentication\DTO;

use fixsickcoder\JsonRpc\Valinor;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends Valinor
{
    /** @var string|null $login Логин пользователя */
    public ?string $login = null;

    /** @var string|null $name Имя пользователя */
    public ?string $name = null;

    /** @var string|null $surname Фамилия пользователя */
    public ?string $surname = null;

    /** @var string|null $midname  Отчество пользователя */
    public ?string $midname = null;

    /** @var string|null $password  Пароль пользователя*/
    public ?string $password = null;

    /** @var string|string[] $permission Права пользователя */
    public string|array $permission = [];

}