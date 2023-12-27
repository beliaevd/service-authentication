<?php

namespace fixsickcoder\ServiceAuthentication\Repository;

use Doctrine\Persistence\ManagerRegistry;
use fixsickcoder\ServiceAuthentication\Entity\Permission;

/**
 * Репозиторий для таблицы прав доступа
 *
 * @method Permission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Permission[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method Permission[] findAll()
 * @method Permission|null findOneBy(array $criteria, ?array $orderBy = null)
 */
class PermissionRepository extends AbstractRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

}