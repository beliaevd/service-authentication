<?php

namespace fixsickcoder\ServiceAuthentication\Entity;

use Doctrine\ORM\Mapping as ORM;
use fixsickcoder\ServiceAuthentication\Repository\PermissionRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
#[ORM\Table(name: 'permissions')]
class Permission
{
    /** @var string|UuidInterface $id Идентификатор записи */
    #[ORM\Id]
    #[ORM\Column(name: 'id', nullable: false)]
    private readonly string|UuidInterface $id;

    /** @var string $name Название доступа */
    #[ORM\Column(name: 'name', length: 40, nullable: false)]
    private string $name;

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * Получение названия доступа
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Установка названия доступа
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Получение идентификатора записи
     *
     * @return UuidInterface|string
     */
    public function getId(): UuidInterface|string
    {
        return $this->id;
    }


}