<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\FavoriteRepository;
use App\Adapter\Favorite\FavoriteMysqlCommand;

class GetStatusPageUseCase
{
    public $favoriteMysqlCommand;

    public function __construct(FavoriteMysqlCommand $favoriteMysqlCommand)
    {
        $this->favoriteMysqlCommand = $favoriteMysqlCommand;
    }

    public function getPageId(int $id)
    {
        return $this->favoriteMysqlCommand->getPageId($id);
    }
}
