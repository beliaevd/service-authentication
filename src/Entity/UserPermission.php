<?php

namespace fixsickcoder\ServiceAuthentication\Entity;

use Doctrine\ORM\Mapping as ORM;
use fixsickcoder\ServiceAuthentication\Repository\UserPermissionRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: UserPermissionRepository::class)]
#[ORM\Table(name: 'users_permissions')]
class UserPermission
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', nullable: false)]
    private readonly string|UuidInterface $id;

    /** @var Permission Категория товара */
    #[ORM\OneToOne(targetEntity: Permission::class)]
    #[ORM\JoinColumn(name: 'permission_id', referencedColumnName: 'id', options: [
        'comment' => 'Идентификатор права'
    ])]
    private Permission $permission;

    /** @var User Категория товара */
    #[ORM\OneToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', options: [
        'comment' => 'Иденификатор пользователя'
    ])]
    private User $user;

    /**
     * Конструтор
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
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


    /**
     * Получение прав доступа
     *
     * @return Permission
     */
    public function getPermission(): Permission
    {
        return $this->permission;
    }

    /**
     * Установка прав доступа
     * @param Permission $permission
     */
    public function setPermission(Permission $permission): void
    {
        $this->permission = $permission;
    }

    /**
     * Получение пользователя
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Установка пользователя
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}