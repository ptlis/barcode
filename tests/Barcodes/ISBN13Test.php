<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\Barcodes\ISBN13;
use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * @covers \ptlis\BarcodeValidation\Barcodes\ISBN13
 * @covers \ptlis\BarcodeValidation\Barcodes\BaseGTINBarcode
 */
final class ISBN13Test extends AbstractBarcodeTestCase
{
    public function getValidator(): ISBN13
    {
        return new ISBN13();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::ISBN_13;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Example' => [
                'barcode' => '1234567890128',
            ],
            'Example with hyphens' => [
                'barcode' => '978-3-16-148410-0',
            ],
            'Example with whitespace padding' => [
                'barcode' => ' 9876543210982  ',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Example' => [
                'barcodeWithoutChecksum' => '123456789012',
                'expectChecksum' => '8',
            ],
            'Example with hyphens' => [
                'barcodeWithoutChecksum' => '978-3-16-148410',
                'expectChecksum' => '0',
            ],
            'Example with whitespace padding' => [
                'barcodeWithoutChecksum' => ' 987654321098  ',
                'expectChecksum' => '2',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Invalid character' => [
                'barcode' => '1234567890I2',
            ],
            'Incorrect checksum' => [
                'barcode' => '123456789011',
            ],
            'Too few characters' => [
                'barcode' => '98765432109',
            ],
            'Too many characters' => [
                'barcode' => '98765432109825',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '1234567890I2',
            ],
            'Too few characters' => [
                'barcodeWithoutChecksum' => '9876532109',
            ],
            'Too many characters' => [
                'barcodeWithoutChecksum' => '98765432109825',
            ],
        ];
    }
}
