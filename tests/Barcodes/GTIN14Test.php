<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\Barcodes\GTIN14;
use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * @covers \ptlis\BarcodeValidation\Barcodes\GTIN14
 * @covers \ptlis\BarcodeValidation\Barcodes\BaseGTINBarcode
 */
final class GTIN14Test extends AbstractBarcodeTestCase
{
    public function getValidator(): GTIN14
    {
        return new GTIN14();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::GTIN_14;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Example 1' => [
                'barcode' => '12345678901231',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Plain example' => [
                'barcodeWithoutChecksum' => '1234567890123',
                'expectChecksum' => '1',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Invalid character' => [
                'barcode' => '1234567890I231',
            ],
            'Incorrect checksum' => [
                'barcode' => '12345678901232',
            ],
            'Too few characters' => [
                'barcode' => '1234567890123',
            ],
            'Too many characters' => [
                'barcode' => '123456789012315',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '1234567890I231',
            ],
            'Too few characters' => [
                'barcodeWithoutChecksum' => '123456789012',
            ],
            'Too many characters' => [
                'barcodeWithoutChecksum' => '12345678901235',
            ],
        ];
    }
}
