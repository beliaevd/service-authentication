<?php

namespace fixsickcoder\ServiceAuthentication\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    /**
     * Метод сохраненния в базу
     *
     * @param object $entity Сущность
     * @param bool $flush Записать сразу
     *
     * @return void
     */
    public function save(object $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Удаление из базы
     *
     * @param object $entity Сущность
     * @param bool $flush Записать сразу
     *
     * @return void
     */
    public function remove(object $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        if($flush)
        {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return parent::getEntityManager();
    }
}