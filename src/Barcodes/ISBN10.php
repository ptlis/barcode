<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\BarcodeTypeEnum;
use ptlis\BarcodeValidation\Interfaces\CalculateChecksumInterface;
use ptlis\BarcodeValidation\Interfaces\TypeInterface;
use ptlis\BarcodeValidation\Interfaces\ValidatorInterface;

/**
 * Validator for ISBN-10 barcodes.
 */
final readonly class ISBN10 implements CalculateChecksumInterface, ValidatorInterface, TypeInterface
{
    use NormalizeISBNTrait;

    public function isValid(string $barcode): bool
    {
        $sum = $this->calculateSum($barcode, 10);

        if (is_null($sum)) {
            return false;
        }

        // The ISBN is valid when the calculated sum can be divided by 11 perfectly
        return ($sum % 11) === 0;
    }

    public function getType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::ISBN_10;
    }

    public function calculateChecksum(string $barcodeWithoutChecksum): ?string
    {
        $sum = $this->calculateSum($barcodeWithoutChecksum, 9);

        if (is_null($sum)) {
            return null;
        }

        return (string)(11 - ($sum % 11));
    }

    private function calculateSum(string $isbn, int $expectLength): ?int
    {
        $isbn = $this->normalizeISBN($isbn, $expectLength);

        if (is_null($isbn)) {
            return null;
        }

        // Sum up the result of 10 x the first digit, 9 x the second digit, and so on ... until the last digit which
        //  will be multiplied by one.
        $sum = 0;

        $digits = str_split($isbn);

        for ($i = 0, $multiplier = 10; $i < count($digits); $i++, $multiplier--) {
            $sum += (int)$digits[$i] * $multiplier;
        }

        return $sum;
    }
}
