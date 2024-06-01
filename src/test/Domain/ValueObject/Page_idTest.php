<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Page_favorite\PageId;

final class Page_idTest extends TestCase
{
    public function testpage_favoriteのIDが1以上である(): void
    {
        $actual = new PageId('1');

        $this->assertEquals('1', $actual->value());
    }
}

