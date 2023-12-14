<?php

namespace fixsickcoder\ServiceAuthentication\Interface;

interface UserInterface
{

    /**
     * Получение данных пользователя для пользователя
     *
     * @param string $id Идентификатор записи пользователя
     *
     * @return array
     */
    public function info(string $id): array;

    /**
     * Добавить пользователя
     *
     * @param array $params Параметры записи пользователя
     *
     * @return array
     */
    public function add(array $params): array;

    /**
     * Удаление пользователя
     *
     * @param string $id Идентификатор записи
     *
     * @return array
     */
    public function remove(string $id): array;

    /**
     * Изменение записи
     *
     * @param array $params Параметры записи пользователя
     *
     * @return array
     */
    public function edit(array $params): array;

    /**
     * Получение данных пользователя для администратора
     *
     * @param string $id Идентификатор записи
     *
     * @return array
     */
    public function get(string $id): array;

    /**
     * Аутентифкация пользователя
     *
     * @param array $params Параметры для входа
     *
     * @return array
     */
    public function login(array $params): array;
}