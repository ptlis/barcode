<?php

declare(strict_types=1);

namespace ptlis\Tests\Barcode\Barcodes;

use ptlis\Barcode\Barcodes\GTIN8;
use ptlis\Barcode\BarcodeTypeEnum;

/**
 * @covers \ptlis\Barcode\Barcodes\GTIN8
 * @covers \ptlis\Barcode\Barcodes\BaseGTINBarcode
 */
final class GTIN8Test extends AbstractBarcodeTestCase
{
    public function getValidator(): GTIN8
    {
        return new GTIN8();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::GTIN_8;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Plain example' => [
                'barcode' => '12345670',
            ],
            'Example with leading/trailing spaces' => [
                'barcode' => '  12345670 ',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Plain example' => [
                'barcodeWithoutChecksum' => '1234567',
                'expectChecksum' => '0',
            ],
            'Example with leading/trailing spaces' => [
                'barcodeWithoutChecksum' => '  1234567 ',
                'expectChecksum' => '0',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Invalid character' => [
                'barcode' => 'I2345670',
            ],
            'Incorrect checksum' => [
                'barcode' => '12345671',
            ],
            'Too few digits' => [
                'barcode' => '1234567',
            ],
            'Too many digits' => [
                'barcode' => '123456702',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => 'I234567',
            ],
            'Too few digits' => [
                'barcodeWithoutChecksum' => '123456',
            ],
            'Too many digits' => [
                'barcodeWithoutChecksum' => '123456702',
            ],
        ];
    }
}
