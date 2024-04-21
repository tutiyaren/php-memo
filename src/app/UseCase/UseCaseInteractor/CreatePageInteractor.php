<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\PageQueryServise;
use App\Adapter\Repository\PageRepository;
use App\UseCase\UseCaseInput\CreatePageInput;
use App\UseCase\UseCaseOutput\CreatePageOutput;
use App\Domain\ValueObject\Page\NewPage;
use App\Adapter\Page\PageMysqlCommand;
use App\Adapter\Page\PageMysqlQuery;

final class CreatePageInteractor
{
    const COMPLETED_MESSAGE = 'メモを追加しました';
    private $pageMysqlCommand;
    private $pageMysqlQuery;
    private $input;

    public function __construct(
        CreatePageInput $input,
        PageMysqlQuery $pageMysqlQuery,
        PageMysqlCommand $pageMysqlCommand
    ) {
        $this->pageMysqlCommand = new PageMysqlCommand();
        $this->pageMysqlQuery = new PageMysqlQuery();
        $this->input = $input;
    }

    public function run(): CreatePageOutput
    {
        if(strlen($this->input->title()->value()) > 30) {
            return new CreatePageOutput(false, 'タイトル30文字以内で');
        }
        if(strlen($this->input->content()->value()) > 100) {
            return new CreatePageOutput(false, '内容100文字以内で');
        }
        $this->createPage();
        return new CreatePageOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createPage(): void
    {
        $newPage = new NewPage(
            $this->input->title(),
            $this->input->content()
        );
        $this->pageMysqlCommand->insert($newPage);
    }
}
