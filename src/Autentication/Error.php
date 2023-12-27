<?php

namespace fixsickcoder\ServiceAuthentication\Autentication;

class Error extends \Exception
{
    /** @var array[] Коды и сообщения ошибок */
    private const  errors = [
        'INCORRECT_LOGIN' => [
            'code' => 5101,
            'message' => 'Неверный логин'
        ],
        'INCORRECT_PASSWORD' => [
            'code' => 5102,
            'message' => 'Неверный пароль'
        ],
        'ACCESS_DENIED' => [
            'code' => 403,
            'message' => 'Доступ запрещён'
        ],
        'INCORRECT_EMAIL' => [
            'code' => 5120,
            'message' => 'Неверный email'
        ]
    ];

    /** @var string[] Неверный логин */
    public const INCORRECT_LOGIN = self::errors['INCORRECT_LOGIN'];

    /** @var string[] Неврный пароль */
    public const INCORRECT_PASSWORD = self::errors['INCORRECT_PASSWORD'];

    /** @var string[] Ошибка доступа */
    public const ACCESS_DENIED = self::errors['ACCESS_DENIED'];

    /** @var string[] Неверный email */
    public const  INCORRECT_EMAIL = self::errors['INCORRECT_EMAIL'];
}