<?php

namespace fixsickcoder\ServiceAuthentication\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use fixsickcoder\ServiceAuthentication\Entity\Permission;

/**
 * Класс фикстур для прав доступа
 * @extends Fixture
 */
class PermissionsFixtures extends Fixture
{

    /**
     * Конструктор
     * @param ManagerRegistry $doctrine
     */
    public function __construct(
        private readonly ManagerRegistry $doctrine
    )
    {
    }

    /**
     * Ициализация фикстуры
     *
     * @param ObjectManager $manager Менеджер
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $this->setData($manager);
        $manager->flush();
    }

    private function loadData(): array
    {
        return [
            [
                'name' => 'user'
            ],
            [
                'name' => 'admin'
            ],
            [
                'name' => 'vip'
            ],
            [
                'name' => 'see'
            ]
        ];
    }

    /**
     * Подготовка entity
     *
     * @param ObjectManager $manager Менеджер
     *
     * @return void
     */
    private function setData(ObjectManager $manager): void
    {
        $data = $this->loadData();
        foreach ($data as $item) {
            $permission = new Permission();
            $permission->setName($item['name']);
            $manager->persist($permission);
        }
    }

    /**
     * Отчистка таблицы
     *
     * @return void
     */
    private function truncateTable(): void
    {
        //#TODO: Сделать отчистку таблицы до заполнения
    }

}