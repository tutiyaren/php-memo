<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\FavoriteQueryServise;
use App\Adapter\Repository\FavoriteRepository;
use App\UseCase\UseCaseInput\EditFavoriteInput;
use App\UseCase\UseCaseOutput\EditFavoriteOutput;
use App\Domain\ValueObject\Page_favorite\EditPage_favorite;
use App\Domain\Entity\Favorite;

final class EditFavoriteInteractor
{
    const COMPLETED_MESSAGE = 'マークを編集しました';
    private $favoriteRepository;
    private $favoriteQueryServise;
    private $input;

    public function __construct(EditFavoriteInput $input)
    {
        $this->favoriteRepository = new FavoriteRepository();
        $this->favoriteQueryServise = new FavoriteQueryServise();
        $this->input = $input;
    }

    public function handler(): EditFavoriteOutput
    {
        $this->editFavorite();
        return new EditFavoriteOutput(true, self::COMPLETED_MESSAGE);
    }

    private function editFavorite(): void
    {
        $newFavorite = new EditPage_favorite(
            $this->input->page_id(),
            $this->input->status()
        );

        $this->favoriteRepository->edit($newFavorite);
    }
}
