<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * Validator for GTIN-8 barcodes.
 */
final readonly class GTIN8 extends BaseGTINBarcode
{
    public function __construct()
    {
        parent::__construct(BarcodeTypeEnum::GTIN_8, 8);
    }
}
