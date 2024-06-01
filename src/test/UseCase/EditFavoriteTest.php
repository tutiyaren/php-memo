<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\EditFavoriteInput;
use App\UseCase\UseCaseInteractor\EditFavoriteInteractor;
use App\Domain\ValueObject\Page_favorite\PageId;
use App\Domain\ValueObject\Page_favorite\Status;
use App\Adapter\Favorite\FavoriteMysqlCommand;
use App\Adapter\Favorite\FavoriteMysqlQuery;

use App\Domain\ValueObject\Page_favorite\EditPage_favorite;


final class EditFavoriteTest extends TestCase
{
    public function test対象のpage_idのstatusが1or0の場合()
    {
        $input = new EditFavoriteInput(
            new PageId(1),
            new Status('1'),
        );
        $favoriteMysqlQuery = new class extends FavoriteMysqlQuery
        {

        };
        $favoriteMysqlCommand = new class extends FavoriteMysqlCommand
        {
            public function edit(EditPage_favorite $favorite): void
            {

            }
        };
        $interactor = new EditFavoriteInteractor($input, $favoriteMysqlQuery, $favoriteMysqlCommand);

        $this->assertSame(true, $interactor->run()->isSuccess());
    }

}
