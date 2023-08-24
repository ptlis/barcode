<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\BarcodeTypeEnum;
use ptlis\BarcodeValidation\Interfaces\CalculateChecksumInterface;
use ptlis\BarcodeValidation\Interfaces\TypeInterface;
use ptlis\BarcodeValidation\Interfaces\ValidatorInterface;

/**
 * Base class that implements the common components for GTIN-family barcodes.
 */
abstract readonly class BaseGTINBarcode implements CalculateChecksumInterface, ValidatorInterface, TypeInterface
{
    public function __construct(
        private BarcodeTypeEnum $type,
        private int $expectedBarcodeLength
    ) {
    }

    public function isValid(string $barcode): bool
    {
        $barcode = trim($barcode);

        // Must have correct number of digits
        if (strlen($barcode) !== $this->expectedBarcodeLength) {
            return false;
        }

        // Must consist only of digits
        if (!ctype_digit($barcode)) {
            return false;
        }

        // Bundled checksum must equal calculated checksum
        return substr($barcode, -1) === $this->calculateChecksum(substr_replace($barcode, '', -1));
    }

    public function getType(): BarcodeTypeEnum
    {
        return $this->type;
    }

    public function calculateChecksum(string $barcodeWithoutChecksum): ?string
    {
        $barcodeWithoutChecksum = trim($barcodeWithoutChecksum);

        // Must have correct number of digits
        if (strlen($barcodeWithoutChecksum) !== $this->expectedBarcodeLength - 1) {
            return null;
        }

        // Must consist only of digits
        if (!ctype_digit($barcodeWithoutChecksum)) {
            return null;
        }

        // Split barcode into the individual digits
        $digits = str_split($barcodeWithoutChecksum);

        // Calculate checksum, from left-to-right sum digits into two buckets (odd/even)
        for ($i = $sumOddDigits = $sumEvenDigits = 0; $i < count($digits); ++$i) {
            if ((($i + 1) % 2) !== 0) {
                $sumOddDigits += (int)$digits[$i];
            } else {
                $sumEvenDigits += (int)$digits[$i];
            }
        }

        // Figure out which sum must be multiplied by 3
        if ((strlen($barcodeWithoutChecksum) % 2) === 0) {
            $sumEvenDigits *= 3;
        } else {
            $sumOddDigits *= 3;
        }

        // Find remainder when the sum of both buckets when divided by 10
        $sumRemainder = ($sumOddDigits + $sumEvenDigits) % 10;

        // The checksum digit is the number which needs to be added to the remainder to equal 10
        return (string)((10 - $sumRemainder) % 10);
    }
}
