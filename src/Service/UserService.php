<?php

namespace fixsickcoder\ServiceAuthentication\Service;

use fixsickcoder\JsonRpc\Exception;
use fixsickcoder\ServiceAuthentication\Autentication\Error;
use fixsickcoder\ServiceAuthentication\Entity\User;
use fixsickcoder\ServiceAuthentication\Entity\UserPermission;
use fixsickcoder\ServiceAuthentication\Interface\UserInterface;
use fixsickcoder\ServiceAuthentication\Repository\PermissionRepository;
use fixsickcoder\ServiceAuthentication\Repository\UserPermissionRepository;
use fixsickcoder\ServiceAuthentication\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService implements UserInterface
{
    /**
     * Конструктор
     *
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $passwordHasher
     * @param PermissionRepository $permissionRepository
     * @param UserPermissionRepository $userPermissionRepository
     */
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly PermissionRepository $permissionRepository,
        private readonly UserPermissionRepository $userPermissionRepository
    )
    {
    }

    /**
     * Аутентификация пользователя
     *
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function login(array $params): array
    {
        $qp = $this->userRepository->createQueryBuilder('q')->where("q.login = '" . $params['login']. "'")->join('q.permission', 'up');

        $permissions = [];
        $query = $qp->getQuery();
        $result = $query->getResult();
        if (empty($result)) {
            throw new Exception(Error::INCORRECT_LOGIN['message'], Error::INCORRECT_LOGIN['code']);
        }
        $result = $result[0];

        if (!$this->passwordHasher->isPasswordValid($result, $params['password'])) {
            throw new Exception(Error::INCORRECT_PASSWORD['message'], Error::INCORRECT_PASSWORD['code']);
        }

        foreach ($result->getPermission() as $item) {
              $permissions[] = $item->getPermission()->getName();
        }

        return [
            'login' => $result->getLogin(),
            'id' => $result->getId(),
            'permissions' => $permissions
        ];
    }

    /**
     * Добавление пользователя
     *
     * @param array $params Параметры запроса
     * @return array
     * @throws Exception
     */
    public function add(array $params): array
    {
        $this->userRepository->getEntityManager()->beginTransaction();
        $user = $this->userRepository->findBy(['login' => $params['login']]);
        if (!empty($user)) {
            throw new Exception("The same login in db", Exception::INVALID_PARAMS);
        }
        $user = new User();
        $user->setName($params['name']);
        $user->setSurname($params['surname']);
        $user->setMidname($params['midname']);
        $user->setLogin($params['login']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $params['password']);
        $user->setPassword($hashedPassword);
        $this->userRepository->save($user);

        //Делаем массив из доступов
        $params['permission'] = !is_array($params['permission'])? [$params['permission']]: $params['permission'];

        foreach ($params['permission']  as $permission) {
            $permissionDb = $this->permissionRepository->find($permission);
            if ($permissionDb === null) {
                throw new Exception("Не установлен доступ", Exception::INVALID_PARAMS);
            }

            $userPermission = new UserPermission();
            $userPermission->setUser($user);
            $userPermission->setPermission($permissionDb);
            $this->userPermissionRepository->save($userPermission);
        }

        try {
            $this->userRepository->getEntityManager()->flush();
            $this->userRepository->getEntityManager()->commit();
        }catch (\Throwable $e) {
            $this->userRepository->getEntityManager()->rollback();
            throw new Exception("Can`t save to db", Exception::DB_ERROR, $e);
        }

        return [
            'id' => $user->getId()
        ];
    }

    /**
     * Удаление пользователя
     *
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function remove(string $id): array
    {
        $this->userRepository->getEntityManager()->beginTransaction();
        $user = $this->userRepository->find($id);
        if ($user === null) {
            throw new Exception("Can`t find user", Exception::INVALID_PARAMS);
        }
        $permissions = $this->userPermissionRepository->findBy(['user' => $id]);

        foreach ($permissions as $permission) {
            $this->userPermissionRepository->remove($permission);
        }

        $this->userRepository->remove($user);
        try {
            $this->userRepository->getEntityManager()->flush();
            $this->userRepository->getEntityManager()->commit();
        }catch (\Throwable $e) {
            $this->userRepository->getEntityManager()->rollback();
            throw new Exception("Can`t delete user", Exception::DB_ERROR);
        }

        return ['removed' => $id];
    }

    /**
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function info(string $id): array
    {
        $qp = $this->userRepository->createQueryBuilder('q')->where("q.id = '" . $id. "'")->join('q.permission', 'up');

        $permissions = [];
        $query = $qp->getQuery();
        $result = $query->getResult();
        if (empty($result)) {
            throw new Exception("Пользователь не найден", Exception::INVALID_PARAMS);
        }
        $result = $result[0];


        foreach ($result->getPermission() as $item) {
            $permissions[] = $item->getPermission()->getName();
        }

        return [
            'id' => $result->getId(),
            'login' => $result->getLogin(),
            'name' => $result->getName(),
            'surname' => $result->getSurname(),
            'midname' => $result->getMidname(),
            'permissions' => $permissions
        ];
    }

    /**
     *
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function edit(array $params): array
    {
        $this->userRepository->getEntityManager()->beginTransaction();
        $user = $this->userRepository->find($params['id']);
        if ($user === null) {
            throw new Exception('Can`t find user id: '. $params['id'], Exception::INVALID_PARAMS);
        }
        $user->setName($params['name']);
        $user->setSurname($params['surname']);
        $user->setMidname($params['midname']);
        $user->setLogin($params['login']);

        $permission = $this->permissionRepository->find($params['permission']);
        if ($permission === null) {
            throw new Exception("Не установлен доступ", Exception::INVALID_PARAMS);
        }

        $userPermission = new UserPermission();
        $userPermission->setUser($user);
        $userPermission->setPermission($permission);

        try {
            $this->userRepository->save($user);
            $this->userPermissionRepository->save($userPermission);
            $this->userRepository->getEntityManager()->commit();
        }catch (\Throwable $e) {
            $this->userRepository->getEntityManager()->rollback();
            throw new Exception("Can`t save to db", Exception::DB_ERROR, $e);
        }


        return ["id" => $user->getId()];
    }


    public function get(string $id): array
    {
        return [];
    }


    public function changePassword(): array
    {
        return [];
    }

    /**
     * Вернуть список доступов
     *
     * @return array
     */
    public function getPermissions(): array
    {
        $permissions = $this->permissionRepository->findAll();
        $response = [];

        foreach ($permissions as $permission) {
            $response[] = [
                'id' => $permission->getId(),
                'name' => $permission->getName()
            ];
        }

        return $response;
    }

}