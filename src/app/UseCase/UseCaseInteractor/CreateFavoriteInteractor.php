<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\FavoriteQueryServise;
use App\Adapter\Repository\FavoriteRepository;
use App\UseCase\UseCaseInput\CreateFavoriteInput;
use App\UseCase\UseCaseOutput\CreateFavoriteOutput;
use App\Domain\ValueObject\Page_favorite\NewPage_favorite;
use App\Domain\Entity\Page_favorites;
use App\Adapter\Favorite\FavoriteMysqlCommand;
use App\Adapter\Favorite\FavoriteMysqlQuery;

final class CreateFavoriteInteractor
{
    const COMPLETED_MESSAGE = 'マークを追加しました';
    private $favoriteMysqlCommand;
    private $favoriteMysqlQuery;
    private $input;

    public function __construct(CreateFavoriteInput $input, FavoriteMysqlQuery $favoriteMysqlQuery, FavoriteMysqlCommand $favoriteMysqlCommand)
    {
        $this->favoriteMysqlCommand = $favoriteMysqlCommand;
        $this->favoriteMysqlQuery = $favoriteMysqlQuery;
        $this->input = $input;
    }

    public function run(): CreateFavoriteOutput
    {
        $this->createFavorite();
        return new CreateFavoriteOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createFavorite(): void
    {
        $newFavorite = new Page_favorites(
            $this->input->page_id(),
            $this->input->status()
        );
        $this->favoriteMysqlCommand->insert($newFavorite);
    }
}
