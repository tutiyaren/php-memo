<?php
namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\PageDao;

final class PageQueryServise
{
    private $pageDao;

    public function __construct()
    {
        $this->pageDao = new PageDao();
    }
}
