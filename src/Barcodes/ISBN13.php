<?php

declare(strict_types=1);

namespace ptlis\Barcode\Barcodes;

use ptlis\Barcode\BarcodeTypeEnum;

/**
 * Validator for ISBN-13 barcodes.
 */
final readonly class ISBN13 extends BaseGTINBarcode
{
    use NormalizeISBNTrait;

    public function __construct()
    {
        parent::__construct(BarcodeTypeEnum::ISBN_13, 13);
    }

    public function calculateChecksum(string $barcodeWithoutChecksum): ?string
    {
        $isbnWithoutChecksum = $this->normalizeISBN($barcodeWithoutChecksum, 12);

        if (is_null($isbnWithoutChecksum)) {
            return null;
        }

        return parent::calculateChecksum($isbnWithoutChecksum);
    }

    public function isValid(string $barcode): bool
    {
        $isbn = $this->normalizeISBN($barcode, 13);

        if (is_null($isbn)) {
            return false;
        }

        return parent::isValid($isbn);
    }
}
