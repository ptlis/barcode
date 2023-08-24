<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\Barcodes\EAN8;
use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * @covers \ptlis\BarcodeValidation\Barcodes\EAN8
 * @covers \ptlis\BarcodeValidation\Barcodes\BaseGTINBarcode
 */
final class EAN8Test extends AbstractBarcodeTestCase
{
    public function getValidator(): EAN8
    {
        return new EAN8();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::EAN_8;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Plain example' => [
                'barcode' => '12345670',
            ],
            'Example with leading/trailing spaces' => [
                'barcode' => '  98765430 ',
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
                'barcodeWithoutChecksum' => '  7654322 ',
                'expectChecksum' => '7',
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
                'barcodeWithoutChecksum' => 'I2345670',
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
