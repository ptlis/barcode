<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\Barcodes\EAN13;
use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * @covers \ptlis\BarcodeValidation\Barcodes\EAN13
 * @covers \ptlis\BarcodeValidation\Barcodes\BaseGTINBarcode
 */
final class EAN13Test extends AbstractBarcodeTestCase
{
    public function getValidator(): EAN13
    {
        return new EAN13();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::EAN_13;
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
                'barcode' => '1234567890129',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '123456L890128',
            ],
        ];
    }
}
