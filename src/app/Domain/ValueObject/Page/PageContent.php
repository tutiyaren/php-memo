<?php
namespace App\Domain\ValueObject\Page;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use Exception;

final class PageContent
{
    const INVALID_MESSAGE = 'コンテンツは100文字以内でお願いします';

    private $value;

    public function __construct(string $value)
    {
        if($this->isInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function isInvalid(string $value): bool
    {
        return mb_strlen($value) > 80;
    }
}
