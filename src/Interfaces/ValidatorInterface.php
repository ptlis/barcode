<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Interfaces;

interface ValidatorInterface
{
    public function isValid(string $barcode): bool;
}
