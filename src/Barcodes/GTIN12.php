<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * Validator for GTIN-12 barcodes.
 */
final readonly class GTIN12 extends BaseGTINBarcode
{
    public function __construct()
    {
        parent::__construct(BarcodeTypeEnum::GTIN_12, 12);
    }
}
