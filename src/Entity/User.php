<?php

namespace fixsickcoder\ServiceAuthentication\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use fixsickcoder\ServiceAuthentication\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', nullable: false)]
    private readonly string|UuidInterface $id;

    /** @var string $login */
    #[ORM\Column(name: 'login', length: 40, nullable: false)]
    private string $login;

    /** @var string $name Имя пользователя */
    #[ORM\Column(name: 'name', length: 40, nullable: false)]
    private string $name;

    /** @var string $surname Фамилия пользователя */
    #[ORM\Column(name: 'surname', length: 40, nullable: false)]
    private string $surname;

    /** @var string $midname Отчество пользователя */
    #[ORM\Column(name: 'midname', length: 40, nullable: false)]
    private string $midname;

    /** @var string $password Пароль пользователя */
    #[ORM\Column(name: 'password', length: 255, nullable: false)]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserPermission::class)]
    private Collection $permission;

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return UuidInterface|string
     */
    public function getId(): UuidInterface|string
    {
        return $this->id;
    }

    /**
     * Получить логин пользователя
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Установка логина пользователя
     *
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * Получение имени пользователя
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Установка имени пользователя
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Получение фамилии пользователя
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Установка фамилии пользователя
     *
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * Получение отчества пользователя
     *
     * @return string
     */
    public function getMidname(): string
    {
        return $this->midname;
    }

    /**
     * Установка отчества пользователя
     *
     * @param string $midname
     */
    public function setMidname(string $midname): void
    {
        $this->midname = $midname;
    }

    /**
     * Поличение пароля пользователя
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Установка пароля пользователя
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return Collection
     */
    public function getPermission(): Collection
    {
        return $this->permission;
    }

}