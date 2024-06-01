<?php
namespace App\Domain\ValueObject\Page;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Page\PageTitle;
use App\Domain\ValueObject\Page\PageContent;

final class NewPage
{
    private $title;
    private $content;

    public function __construct(PageTitle $title, PageContent $content)
    {
        $this->title = $title;
        $this->content = $content;
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
