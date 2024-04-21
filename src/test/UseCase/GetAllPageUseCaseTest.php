<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetAllPageUseCase;
use App\Adapter\Page\PageMysqlCommand;

final class GetAllPageUseCaseTest extends TestCase
{
    public function testトップページですべてのデータを取得できる場合()
    {
        $interactor = new GetAllPageUseCase(new PageMysqlCommand());
        $actualPageData = $interactor->readAllPage();

        $this->assertIsArray($actualPageData);
        $this->assertNotEmpty($actualPageData);
    }

    public function testトップページで検索したデータを取得できる場合()
    {
        $searchKeyword = 'A';
        $interactor = new GetAllPageUseCase(new PageMysqlCommand());
        $actualPageData = $interactor->searchAllPage($searchKeyword);

        $this->assertIsArray($actualPageData);
        $this->assertNotEmpty($actualPageData);
    }
}
