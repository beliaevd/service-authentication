<?php

namespace fixsickcoder\ServiceAuthentication\Repository;

use Doctrine\Persistence\ManagerRegistry;
use fixsickcoder\ServiceAuthentication\Entity\User;

/**
 * Репозиторий для работы с таблицей пользователей
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method User[] findAll()
 * @method User|null findOneBy(array $criteria, ?array $orderBy = null)
 */
class UserRepository extends AbstractRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

}