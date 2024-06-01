<?php
namespace App\Adapter\Favorite;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\FavoriteDao;
use App\Domain\ValueObject\Favorite\NewFavorite;
use App\Domain\ValueObject\Favorite\EditFavorite;
use App\Domain\ValueObject\Page_favorite\EditPage_favorite;
use App\Domain\Entity\Page_favorites;
use App\Domain\ValueObject\Page_favorite\NewPage_favorite;
use App\Domain\Entity\Page_favorites;
use App\Domain\ValueObject\Page_favorite\EditPage_favorite;

class FavoriteMysqlCommand
{
    private $favoriteDao;

    public function __construct()
    {
        $this->favoriteDao = new FavoriteDao();
    }
    public function insert(Page_favorites $favorite)
    {
        $this->favoriteDao->create($favorite);
    }


    public function edit(EditPage_favorite $favorite)
    {
        $this->favoriteDao->update($favorite);
    }


    public function getPageId(int $id): array
    {
        return $this->favoriteDao->getPageId($id);
    }
}

