<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation\Barcodes;

use ptlis\BarcodeValidation\Barcodes\ISBN10;
use ptlis\BarcodeValidation\BarcodeTypeEnum;

/**
 * @covers \ptlis\BarcodeValidation\Barcodes\ISBN10
 */
final class ISBN10Test extends AbstractBarcodeTestCase
{
    public function getValidator(): ISBN10
    {
        return new ISBN10();
    }

    public function getExpectedType(): BarcodeTypeEnum
    {
        return BarcodeTypeEnum::ISBN_10;
    }

    public static function isValidValidBarcodesProvider(): array
    {
        return [
            'Example' => [
                'barcode' => '0395362962',
            ],
            'Example with hyphens' => [
                'barcode' => '05-750-9419-2',
            ],
            'Example with whitespace padding' => [
                'barcode' => ' 0575075066  ',
            ],
        ];
    }

    public static function calculateChecksumValidDataProvider(): array
    {
        return [
            'Example' => [
                'barcodeWithoutChecksum' => '039536296',
                'expectChecksum' => '2',
            ],
            'Example with hyphens' => [
                'barcodeWithoutChecksum' => '05-750-9419',
                'expectChecksum' => '2',
            ],
            'Example with whitespace padding' => [
                'barcodeWithoutChecksum' => ' 057507506  ',
                'expectChecksum' => '6',
            ],
        ];
    }

    public static function isValidInvalidBarcodesProvider(): array
    {
        return [
            'Too few digits' => [
                'barcode' => '451',
            ],
            'Too many digits' => [
                'barcode' => '0395873629652',
            ],
            'Invalid character' => [
                'barcode' => '05750L5066',
            ],
        ];
    }

    public static function calculateChecksumInvalidDataProvider(): array
    {
        return [
            'Invalid character' => [
                'barcodeWithoutChecksum' => '05750L5066',
            ],
            'Too few digits' => [
                'barcodeWithoutChecksum' => '451',
            ],
            'Too many digits' => [
                'barcodeWithoutChecksum' => '0395873629652',
            ],
        ];
    }
}
