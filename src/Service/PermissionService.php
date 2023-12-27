<?php

namespace fixsickcoder\ServiceAuthentication\Service;

use fixsickcoder\JsonRpc\Exception;
use fixsickcoder\ServiceAuthentication\Entity\Permission;
use fixsickcoder\ServiceAuthentication\Repository\PermissionRepository;

class PermissionService
{
    /**
     * Конструктор
     */
    public function __construct(
        private readonly PermissionRepository $repository
    )
    {
    }

    public function add(string $name): array
    {
        $response = [];

        $permission = new Permission();
        $permission->setName($name);
        $this->repository->save($permission);

        try {
         $this->repository->getEntityManager()->flush();
        }catch (\Throwable) {
            throw new Exception("Can`t save data", Exception::DB_ERROR);
        }
        return $response;
    }

}