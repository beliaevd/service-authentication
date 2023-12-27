<?php

namespace fixsickcoder\ServiceAuthentication\Repository;

use Doctrine\Persistence\ManagerRegistry;
use fixsickcoder\ServiceAuthentication\Entity\UserPermission;

/**
 * Репозиторий для таблицы прав пользователя
 *
 * @method UserPermission|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPermission[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method UserPermission[] findAll()
 * @method UserPermission|null findOneBy(array $criteria, ?array $orderBy = null)
 */

class UserPermissionRepository extends AbstractRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPermission::class);
    }
}