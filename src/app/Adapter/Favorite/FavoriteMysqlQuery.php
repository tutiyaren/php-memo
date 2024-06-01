<?php

namespace App\Adapter\Favorite;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\FavoriteDao;

class FavoriteMysqlQuery
{
    private $favoriteDao;

    public function __construct()
    {
        $this->favoriteDao = new FavoriteDao();
    }

    
}