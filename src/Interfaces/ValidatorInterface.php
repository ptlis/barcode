<?php

declare(strict_types=1);

namespace ptlis\Barcode\Interfaces;

interface ValidatorInterface
{
    public function isValid(string $barcode): bool;
}
