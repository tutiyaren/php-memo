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

final class CreateFavoriteTest extends TestCase
{
    public function test0の値がstatusにある場合()
    {
        $input = new CreateFavoriteInput(
            new PageId(20),
            new Status(0),
        );
        $interactor = new CreateFavoriteInteractor($input, new FavoriteMysqlQuery(), new FavoriteMysqlCommand());
        $this->assertSame(true, $interactor->run()->isSuccess());
    }
    public function test1の値がstatusにある場合()
    {
        $input = new CreateFavoriteInput(
            new PageId(29),
            new Status(1),
        );
        $interactor = new CreateFavoriteInteractor($input, new FavoriteMysqlQuery(), new FavoriteMysqlCommand());
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
        $interactor = new CreateFavoriteInteractor($input, new FavoriteMysqlQuery(), new FavoriteMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
