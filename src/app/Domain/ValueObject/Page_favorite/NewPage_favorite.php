<?php
namespace App\Domain\ValueObject\Page_favorite;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Page_favorite\PageId;
use App\Domain\ValueObject\Page_favorite\Status;

final class NewPage_favorite
{
    private $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function status(): Status
    {
        return $this->status;
    }
}
