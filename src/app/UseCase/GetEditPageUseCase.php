<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\PageRepository;
use App\Adapter\Page\PageMysqlCommand;

class GetEditPageUseCase
{
    public $pageMysqlCommand;

    public function __construct(PageMysqlCommand $pageMysqlCommand)
    {
        $this->pageMysqlCommand = $pageMysqlCommand;
    }

    public function readEditPage($id)
    {
        return $this->pageMysqlCommand->readEdit($id);
    }
}
