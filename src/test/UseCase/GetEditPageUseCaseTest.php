<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetEditPageUseCase;
use App\Adapter\Page\PageMysqlCommand;

final class GetEditPageUseCaseTest extends TestCase
{
    public function test編集ページで対象のメモデータを取得できる場合()
    {
        $id = 5;
        $pageData = [
            'id' => 5,
            'title' => 'AAA',
            'content' => 'aaaaaaaaAA',
            'created_at' => '2024-04-21 14:36:30',
            'updated_at' => '2024-04-21 16:01:02',
        ];
        $pageMysqlCommand = new class extends PageMysqlCommand
        {
           
        };
        $interactor = new GetEditPageUseCase($pageMysqlCommand);
        $actualPageData = $interactor->readEditPage($id);
        $this->assertEquals($pageData, $actualPageData);
    }
}
