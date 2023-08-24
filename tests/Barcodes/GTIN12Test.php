<?php

declare(strict_types=1);

namespace ptlis\Tests\Barcode\Barcodes;

use ptlis\Barcode\Barcodes\GTIN12;
use ptlis\Barcode\BarcodeTypeEnum;

/**
 * @covers \ptlis\Barcode\Barcodes\GTIN12
 * @covers \ptlis\Barcode\Barcodes\BaseGTINBarcode
 */
final class GTIN12Test extends AbstractBarcodeTestCase
{
    public function getValidator(): GTIN12
    {
        return new GTIN12();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::GTIN_12;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Example 1' => [
                'barcode' => '123456789012',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Plain example' => [
                'barcodeWithoutChecksum' => '12345678901',
                'expectChecksum' => '2',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Invalid character' => [
                'barcode' => '123456L89012',
            ],
            'Incorrect checksum' => [
                'barcode' => '123456789013',
            ],
            'Too few characters' => [
                'barcode' => '12345678901',
            ],
            'Too many characters' => [
                'barcode' => '1234567890123',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '123456L8901',
            ],
            'Too few characters' => [
                'barcodeWithoutChecksum' => '1234567890',
            ],
            'Too many characters' => [
                'barcodeWithoutChecksum' => '1234567890123',
            ],
        ];
    }
}
