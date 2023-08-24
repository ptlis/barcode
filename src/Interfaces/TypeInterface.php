<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Interfaces;

use ptlis\BarcodeValidation\BarcodeTypeEnum;

interface TypeInterface
{
    public function getType(): BarcodeTypeEnum;
}
