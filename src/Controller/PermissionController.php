<?php

namespace fixsickcoder\ServiceAuthentication\Controller;

use fixsickcoder\JsonRpc\Controller;
use fixsickcoder\ServiceAuthentication\Service\PermissionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PermissionController extends Controller
{
    public function __construct(
        private readonly PermissionService $service
    )
    {
    }

    /**
     * End-point
     *
     * @param Request $request Параметы запроса
     * @return JsonResponse
     */
    #[Route('/permission')]
    public function index(Request $request): JsonResponse
    {
        return parent::index($request); // TODO: Change the autogenerated stub
    }

    /**
     *
     * @return array
     */
    public function list(): array
    {
        return [];
    }

    /**
     *
     *
     * @return array
     */
    public function get(): array
    {
        return [];
    }

    /**
     * Добавление доступа
     *
     * @param string $name
     * @return array
     * @throws \fixsickcoder\JsonRpc\Exception
     */
    public function add(string $name): array
    {
        return $this->service->add($name);
    }
}