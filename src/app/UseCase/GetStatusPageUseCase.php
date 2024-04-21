<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\FavoriteRepository;

class GetStatusPageUseCase
{
    public $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function getPageId(int $id): array
    {
        return $this->favoriteRepository->getPageId($id);
    }
}
