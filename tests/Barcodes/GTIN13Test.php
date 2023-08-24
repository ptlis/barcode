<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\Barcodes\GTIN13;
use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * @covers \ptlis\BarcodeValidation\Barcodes\GTIN13
 * @covers \ptlis\BarcodeValidation\Barcodes\BaseGTINBarcode
 */
final class GTIN13Test extends AbstractBarcodeTestCase
{
    public function getValidator(): GTIN13
    {
        return new GTIN13();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::GTIN_13;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Plain example' => [
                'barcode' => '1234567890128',
            ],
            'Example with leading/trailing spaces' => [
                'barcode' => '  1234567890128 ',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Plain example' => [
                'barcodeWithoutChecksum' => '123456789012',
                'expectChecksum' => '8',
            ],
            'Example with leading/trailing spaces' => [
                'barcodeWithoutChecksum' => '  987654321098 ',
                'expectChecksum' => '2',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Invalid character' => [
                'barcode' => '123456L890128',
            ],
            'Incorrect checksum' => [
                'barcode' => '123456789012',
            ],
            'Too few characters' => [
                'barcode' => '123456789012',
            ],
            'Too many characters' => [
                'barcode' => '12345678901253',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '123456L890128',
            ],
            'Too few characters' => [
                'barcodeWithoutChecksum' => '12345678901',
            ],
            'Too many characters' => [
                'barcodeWithoutChecksum' => '12345678901253',
            ],
        ];
    }
}
