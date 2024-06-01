<?php
namespace App\Domain\ValueObject\Page;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Page\PageId;
use App\Domain\ValueObject\Page\PageTitle;
use App\Domain\ValueObject\Page\PageContent;

final class EditPage
{
    private $id;
    private $title;
    private $content;

    public function __construct(PageId $id, PageTitle $title, PageContent $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function id(): PageId
    {
        return $this->id;
    }

    public function title(): PageTitle
    {
        return $this->title;
    }

    public function content(): PageContent
    {
        return $this->content;
    }
}
