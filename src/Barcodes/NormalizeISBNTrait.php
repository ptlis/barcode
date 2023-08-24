<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Barcodes;

trait NormalizeISBNTrait
{
    /**
     * Returns the normalized value on success, null if the ISBN is invalid.
     *
     * ISBNs may contain hyphens in variable positions; what these denote isn't relevant to validation so this function
     *  will strip them out and return a string containing only digits.
     */
    protected function normalizeISBN(string $isbn, int $expectLength): ?string
    {
        $characters = str_split(trim($isbn));
        $digits = [];

        // Accumulate digits and return false if invalid character is present
        foreach ($characters as $character) {
            if (ctype_digit($character)) {
                $digits[] = $character;
            } elseif ($character !== '-') {
                // Character is not a digit or a hyphen, so is not a valid ISBN-13 barcode
                return null;
            }
        }

        if (count($digits) !== $expectLength) {
            return null;
        }

        return join('', $digits);
    }
}
