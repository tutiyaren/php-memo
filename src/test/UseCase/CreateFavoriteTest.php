<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\CreateFavoriteInput;
use App\UseCase\UseCaseInteractor\CreateFavoriteInteractor;
use App\Domain\ValueObject\Page_favorite\PageId;
use App\Domain\ValueObject\Page_favorite\Status;
use App\Adapter\Favorite\FavoriteMysqlCommand;
use App\Adapter\Favorite\FavoriteMysqlQuery;
use App\Domain\ValueObject\Page_favorite\NewPage_favorite;
use App\Domain\Entity\Page_favorites;

final class CreateFavoriteTest extends TestCase
{
    public function test0の値がstatusにある場合()
    {
        $input = new CreateFavoriteInput(
            new PageId(30),
            new Status(0),
        );
        $favoriteMysqlQuery = new class extends FavoriteMysqlQuery
        {

        };
        $favoriteMysqlCommand = new class extends FavoriteMysqlCommand
        {
            public function insert(Page_favorites $favorite): void
            {

            }
        };
        $interactor = new CreateFavoriteInteractor($input, $favoriteMysqlQuery, $favoriteMysqlCommand);
        $this->assertSame(true, $interactor->run()->isSuccess());
    }
    public function test1の値がstatusにある場合()
    {
        $input = new CreateFavoriteInput(
            new PageId(39),
            new Status(1),
        );
        $favoriteMysqlQuery = new class extends FavoriteMysqlQuery
        {

        };
        $favoriteMysqlCommand = new class extends FavoriteMysqlCommand
        {
            public function insert(Page_favorites $favorite): void
            {

            }
        };
        $interactor = new CreateFavoriteInteractor($input, $favoriteMysqlQuery, $favoriteMysqlCommand);
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function test2の値がstatusにある場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('不正な値です');

        $input = new CreateFavoriteInput(
            new PageId(1),
            new Status(2),
        );
        $favoriteMysqlQuery = new class extends FavoriteMysqlQuery
        {

        };
        $favoriteMysqlCommand = new class extends FavoriteMysqlCommand
        {
            public function insert(Page_favorites $favorite): void
            {

            }
        };
        $interactor = new CreateFavoriteInteractor($input, $favoriteMysqlQuery, $favoriteMysqlCommand);

        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
