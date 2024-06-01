<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\PageRepository;

class GetEditPageUseCase
{
    public $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function readEditPage($id)
    {
        return $this->pageRepository->readEdit($id);
    }
}
