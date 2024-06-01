<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Page\PageTitle;

final class PageTitleTest extends TestCase
{
    /**
     * @test
     */
    public function testブログのタイトルが30字以内であること(): void
    {
        $actual = new PageTitle('あいうえおあいうえおあいうえおあいうえお');

        $this->assertSame('あいうえおあいうえおあいうえおあいうえお', $actual->value());
    }

    /**
     * @test
     */
    public function testブログのタイトルが31字以上であること(): void
    {
        $this->expectException(\Exception::class);

        new PageTitle('あいうえおあいうえおあいうえおあいうえおあ');
    }
}

