<?php
namespace App\Domain\ValueObject\Page_favorite;
use Exception;

final class Status
{
    const MIN_VALUE = 0;
    const MAX_VALUE = 1;
    const INVALID_MESSAGE = '不正な値です';
    private $value;

    public function __construct(int $value)
    {
        if($this->isMinInvalid($value) || $this->isMaxInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isMinInvalid(int $value): bool
    {
        return $value < self::MIN_VALUE;
    }

    public function isMaxInvalid(int $value): bool
    {
        return $value > self::MAX_VALUE;
    }
}
