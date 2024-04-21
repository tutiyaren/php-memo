<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetStatusPageUseCase;
use App\Adapter\Favorite\FavoriteMysqlCommand;

final class GetStatusPageUseCaseTest extends TestCase
{
    public function test対象のデータを取得できる場合()
    {
        $id = 39;
        $expectedFavoriteData = [
            'page_id' => 39,
            'status' => 1,
            'created_at' => '2024-04-21 19:47:43',
            'updated_at' => '2024-04-21 19:47:43'
        ];

        $interactor = new GetStatusPageUseCase(new FavoriteMysqlCommand());
        $actualFavoriteData = $interactor->getPageId($id);
        $this->assertEquals($expectedFavoriteData, $actualFavoriteData);
    }
}