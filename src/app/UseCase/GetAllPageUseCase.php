<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\PageRepository;

class GetAllPageUseCase
{
    public $pageAllRepository;

    public function __construct(PageRepository $pageAllRepository)
    {
        $this->pageAllRepository = $pageAllRepository;
    }

    public function readAllPage()
    {
        return $this->pageAllRepository->allPage();
    }

    public function searchAllPage($keyword)
    {
        return $this->pageAllRepository->searchPage($keyword);
    }
}
