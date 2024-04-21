<?php
namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\FavoriteDao;

final class FavoriteQueryServise
{
    private $favoriteDao;

    public function __construct()
    {
        $this->favoriteDao = new FavoriteDao();
    }
}
