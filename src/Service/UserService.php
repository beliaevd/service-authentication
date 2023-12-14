<?php

namespace fixsickcoder\ServiceAuthentication\Service;

use fixsickcoder\ServiceAuthentication\Interface\UserInterface;

class UserService implements UserInterface
{
    /**
     * Конструтор
     */
    public function __construct()
    {
    }

    public function login(array $params): array
    {
        return [];
    }

    public function add(array $params): array
    {
        return [];
    }

    public function remove(string $id): array
    {
        return [];
    }

    public function info(string $id): array
    {
        return [];
    }

    public function edit(array $params): array
    {
        return [];
    }

    public function get(string $id): array
    {
        return [];
    }
}