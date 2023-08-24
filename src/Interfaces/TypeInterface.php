<?php

declare(strict_types=1);

namespace ptlis\Barcode\Interfaces;

use ptlis\Barcode\BarcodeTypeEnum;

interface TypeInterface
{
    public function getType(): BarcodeTypeEnum;
}
