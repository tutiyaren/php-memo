<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\PageQueryServise;
use App\Adapter\Repository\PageRepository;
use App\UseCase\UseCaseInput\EditPageInput;
use App\UseCase\UseCaseOutput\EditPageOutput;
use App\Domain\ValueObject\Page\EditPage;
use App\Domain\Entity\Page;
use App\Adapter\Page\PageMysqlCommand;
use App\Adapter\Page\PageMysqlQuery;

final class EditPageInteractor
{
    const COMPLETED_MESSAGE = 'メモを編集しました';
    private $input;
    private $pageMysqlCommand;
    private $pageMysqlQuery;

    public function __construct(
        EditPageInput $input,
        PageMysqlQuery $pageMysqlQuery,
        PageMysqlCommand $pageMysqlCommand
    ) {
        $this->pageMysqlQuery = $pageMysqlQuery;
        $this->pageMysqlCommand = $pageMysqlCommand;
        $this->input = $input;
    }

    public function run(): EditPageOutput
    {
        if(strlen($this->input->title()->value()) > 20) {
            return new EditPageOutput(false, 'タイトル30文字以内で');
        }
        if(strlen($this->input->content()->value()) > 80) {
            return new EditPageOutput(false, '内容100文字以内で');
        }
        $this->editPage();
        return new EditPageOutput(true, self::COMPLETED_MESSAGE);
    }

    private function editPage(): void
    {
        $newPage = new EditPage(
            $this->input->id(),
            $this->input->title(),
            $this->input->content()
        );

        $this->pageMysqlCommand->edit($newPage);
    }
}