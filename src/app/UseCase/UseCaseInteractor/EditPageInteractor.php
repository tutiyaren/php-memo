<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\PageQueryServise;
use App\Adapter\Repository\PageRepository;
use App\UseCase\UseCaseInput\EditPageInput;
use App\UseCase\UseCaseOutput\EditPageOutput;
use App\Domain\ValueObject\Page\EditPage;
use App\Domain\Entity\Page;

final class EditPageInteractor
{
    const COMPLETED_MESSAGE = 'メモを編集しました';
    private $pageRepository;
    private $pageQueryServise;
    private $input;

    public function __construct(EditPageInput $input)
    {
        $this->pageRepository = new PageRepository();
        $this->pageQueryServise = new PageQueryServise();
        $this->input = $input;
    }

    public function handler(): EditPageOutput
    {
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

        $this->pageRepository->edit($newPage);
    }
}