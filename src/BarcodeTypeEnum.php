<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation;

enum BarcodeTypeEnum: string
{
    // EAN barcodes
    case EAN_8 = 'EAN-8';
    case EAN_13 = 'EAN-13';

    // GTIN barcodes
    case GTIN_8 = 'GTIN-8';
    case GTIN_12 = 'GTIN-12';
    case GTIN_13 = 'GTIN-13';
    case GTIN_14 = 'GTIN-14';
    case SSCC = 'SSCC';

    // ISBN format
    case ISBN_10 = 'ISBN-10';
    case ISBN_13 = 'ISBN-13';

    // UPC
    case UPC_A = 'UPC-A';
}
