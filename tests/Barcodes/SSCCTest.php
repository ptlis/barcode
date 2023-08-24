<?php

declare(strict_types=1);

namespace ptlis\Tests\Barcode\Barcodes;

use ptlis\Barcode\Barcodes\SSCC;
use ptlis\Barcode\BarcodeTypeEnum;

/**
 * @covers \ptlis\Barcode\Barcodes\SSCC
 * @covers \ptlis\Barcode\Barcodes\BaseGTINBarcode
 */
final class SSCCTest extends AbstractBarcodeTestCase
{
    public function getValidator(): SSCC
    {
        return new SSCC();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::SSCC;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Example' => [
                'barcode' => '123456789012345675',
            ],
            'Example with whitespace padding' => [
                'barcode' => '  123456789012345675   ',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Example' => [
                'barcodeWithoutChecksum' => '12345678901234567',
                'expectChecksum' => '5',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Invalid character' => [
                'barcode' => '1234567890I2345675',
            ],
            'Wrong checksum' => [
                'barcode' => '123456789012345674',
            ],
            'Too few characters' => [
                'barcode' => '12345678901234567',
            ],
            'Too many characters' => [
                'barcode' => '1234567890123456755',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '123456789O1234567',
            ],
            'Too few characters' => [
                'barcodeWithoutChecksum' => '1234567890123456',
            ],
            'Too many characters' => [
                'barcodeWithoutChecksum' => '1234567890123456755',
            ],
        ];
    }
}
