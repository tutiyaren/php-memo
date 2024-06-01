<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Page\PageId;

final class PageIdTest extends TestCase
{
    public function testページIDが1以上の場合_例外が発生しないこと(): void
    {
        $actual = new PageId('1');
        $this->assertEquals('1', $actual->value());
    }

    public function testページIDが1未満の場合_例外が発生すること(): void
    {
        $this->expectException(\Exception::class);
        new PageId('0');
    }
}
