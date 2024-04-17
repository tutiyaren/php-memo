<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\PageQueryServise;
use App\Adapter\Repository\PageRepository;
use App\UseCase\UseCaseInput\CreatePageInput;
use App\UseCase\UseCaseOutput\CreatePageOutput;
use App\Domain\ValueObject\Page\NewPage;

final class CreatePageInteractor
{
    const COMPLETED_MESSAGE = 'メモを追加しました';
    private $pageRepository;
    private $pageQueryServise;
    private $input;

    public function __construct(CreatePageInput $input)
    {
        $this->pageRepository = new PageRepository();
        $this->pageQueryServise = new PageQueryServise();
        $this->input = $input;
    }

    public function handler(): CreatePageOutput
    {
        $this->createPage();
        return new CreatePageOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createPage(): void
    {
        $newPage = new NewPage(
            $this->input->title(),
            $this->input->content()
        );
        $this->pageRepository->insert($newPage);
    }
}
