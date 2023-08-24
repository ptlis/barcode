<?php

declare(strict_types=1);

namespace ptlis\Barcode\Barcodes;

use ptlis\Barcode\BarcodeTypeEnum;

/**
 * Validator for GTIN-14 barcodes.
 */
final readonly class GTIN14 extends BaseGTINBarcode
{
    public function __construct()
    {
        parent::__construct(BarcodeTypeEnum::GTIN_14, 14);
    }
}
