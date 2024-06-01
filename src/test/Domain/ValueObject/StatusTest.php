<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Page_favorite\Status;

final class StatusTest extends TestCase
{
    public function testステータスがIDが1である(): void
    {
        $actual = new Status('1');

        $this->assertEquals('1', $actual->value());
    }

    public function testステータスがIDが0である(): void
    {
        $actual = new Status('0');

        $this->assertEquals('0', $actual->value());
    }
    public function testステータスがIDが2である(): void
    {
        $this->expectException(\Exception::class);
        new Status('2');
    }
}

