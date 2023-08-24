<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * Validator for EAN-8 barcodes.
 */
final readonly class EAN8 extends BaseGTINBarcode
{
    public function __construct()
    {
        parent::__construct(BarcodeTypeEnum::EAN_8, 8);
    }
}
