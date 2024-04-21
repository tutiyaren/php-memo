<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\CreatePageInput;
use App\UseCase\UseCaseInteractor\CreatePageInteractor;
use App\Domain\ValueObject\Page\PageId;
use App\Domain\ValueObject\Page\PageTitle;
use App\Domain\ValueObject\Page\PageContent;
use App\Adapter\Page\PageMysqlQuery;
use App\Adapter\Page\PageMysqlCommand;

final class CreatePageTest extends TestCase
{
    public function testタイトルと内容に値が入っていて、タイトル30文字以下かつ、内容100文字以下の場合()
    {
        $input = new CreatePageInput(
            new PageTitle('AAA'),
            new PageContent('aaaaaaaa')
        );
        $interactor = new CreatePageInteractor($input, new PageMysqlQuery(), new PageMysqlCommand());
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function testタイトル31文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('タイトルは30ジ以内でお願いします');
        $input = new CreatePageInput(
            new PageTitle('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ'),
            new PageContent('aaaaaaaa'),
        );
        $interactor = new CreatePageInteractor($input, new PageMysqlQuery(), new PageMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }

    public function test内容が101文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('コンテンツは100文字以内でお願いします');
        $input = new CreatePageInput(
            new PageTitle('AAA'),
            new PageContent('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおおあいうえおあいうえおあ'),
        );
        $interactor = new CreatePageInteractor($input, new PageMysqlQuery(), new PageMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
