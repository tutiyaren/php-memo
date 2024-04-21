<?php
namespace App\Adapter\Repository;
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Domain\Entity\Page_favorites;
use App\Infrastructure\Dao\FavoriteDao;
use App\Domain\ValueObject\Page_favorite\EditPage_favorite;
use App\Domain\ValueObject\Page_favorite\NewPage_favorite;

final class FavoriteRepository
{
    private $favoriteDao;

    public function __construct()
    {
        $this->favoriteDao = new FavoriteDao();
    }

    public function insert(Page_favorites $favorite): void
    {
        $this->favoriteDao->create($favorite);
    }

    public function edit(EditPage_favorite $favorite): void
    {
        $this->favoriteDao->update($favorite);
    }

    public function getPageId(int $favorite): array
    {
        return $this->favoriteDao->getPageId($favorite);
    }
}
