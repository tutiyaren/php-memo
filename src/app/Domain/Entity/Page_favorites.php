<?php
namespace App\Domain\Entity;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Page_favorite\PageId;
use App\Domain\ValueObject\Page_favorite\Status;

final class Page_favorites
{
    private $page_id;
    private $status;

    public function __construct(PageId $page_id, Status $status)
    {
        $this->page_id = $page_id;
        $this->status = $status;
    }

    public function page_id(): PageId
    {
        return $this->page_id;
    }

    public function status(): Status
    {
        return $this->status;
    }
}
