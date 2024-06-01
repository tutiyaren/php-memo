<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\EditPageInput;
use App\UseCase\UseCaseInteractor\EditPageInteractor;
use App\Domain\ValueObject\Page\PageId;
use App\Domain\ValueObject\Page\PageTitle;
use App\Domain\ValueObject\Page\PageContent;
use App\Adapter\Page\PageMysqlCommand;
use App\Adapter\Page\PageMysqlQuery;
use App\Domain\ValueObject\Page\EditPage;

final class EditPageTest extends TestCase
{
    public function testタイトルに値が入っていて、タイトル30文字以下かつ、内容100文字以内の場合()
    {
        $input = new EditPageInput(
            new PageId(1),
            new PageTitle('AAA'),
            new PageContent('aaaaaaaaa')
        );
        $pageMysqlQuery = new class extends PageMysqlQuery
        {

        };
        $pageMysqlCommand = new class extends PageMysqlCommand
        {
            public function edit(EditPage $page): void
            {

            }
        };
        $interactor = new EditPageInteractor($input,  $pageMysqlQuery, $pageMysqlCommand);
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function testタイトル31文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('タイトルは30ジ以内でお願いします');

        $input = new EditPageInput(
            new PageId(1),
            new PageTitle('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ'),
            new PageContent('aaaaaaaaa')
        );
        $pageMysqlQuery = new class extends PageMysqlQuery
          {

          };
          $pageMysqlCommand = new class extends PageMysqlCommand
          {
              public function edit(EditPage $page): void
              {

              }
          };
          $interactor = new EditPageInteractor($input,  $pageMysqlQuery, $pageMysqlCommand);
        $this->assertSame(false, $interactor->run()->isSuccess());
    }

    public function test内容が101文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('コンテンツは100文字以内でお願いします');
        $input = new EditPageInput(
            new PageId(1),
            new PageTitle('AAA'),
            new PageContent('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ')
        );
        $pageMysqlQuery = new class extends PageMysqlQuery
        {

        };
        $pageMysqlCommand = new class extends PageMysqlCommand
        {
            public function edit(EditPage $page): void
            {

            }
        };
        $interactor = new EditPageInteractor($input,  $pageMysqlQuery, $pageMysqlCommand);
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
