<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\PageRepository;
use App\Adapter\Page\PageMysqlCommand;

class GetAllPageUseCase
{
    public $pageAllCommand;

    public function __construct(PageMysqlCommand $pageAllCommand)
    {
        $this->pageAllCommand = $pageAllCommand;
    }

    public function readAllPage()
    {
        return $this->pageAllCommand->allPage();
    }

    public function searchAllPage($keyword)
    {
        return $this->pageAllCommand->searchPage($keyword);
    }
}
