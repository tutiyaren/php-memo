<?php
namespace App\Adapter\Page;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\PageDao;

class PageMysqlQuery
{
    private $pageDao;

    public function __construct()
    {
        $this->pageDao = new PageDao();
    }
}
