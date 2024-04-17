<?php
namespace APp\Domain\ValueObject\Page;
use Exception;

final class PageTitle
{
    const INVALID_MESSAGE = 'タイトルは30ジ以内でお願いします';

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

    public function isInvalid(string $value): bool
    {
        return mb_strlen($value) > 20;
    }
}
