<?php
namespace App\Adapter\Repository;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\PageDao;
use App\Domain\ValueObject\Page\NewPage;
use App\Domain\ValueObject\Page\EditPage;

final class PageRepository
{
    private $pageDao;

    public function __construct()
    {
        $this->pageDao = new PageDao();
    }

    public function insert(NewPage $page): void
    {
        $this->pageDao->create($page);
    }

    public function edit(EditPage $page): void
    {
        $this->pageDao->update($page);
    }

    public function readEdit($id)
    {
        return $this->pageDao->readEdit($id);
    }

    public function allPage()
    {
        return $this->pageDao->allPage();
    }

    public function searchPage($keyword)
    {
        return $this->pageDao->searchPage($keyword);
    }
}
