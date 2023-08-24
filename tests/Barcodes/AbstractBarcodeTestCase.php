<?php

declare(strict_types=1);

namespace ptlis\Tests\Barcode\Barcodes;

use PHPUnit\Framework\TestCase;
use ptlis\Barcode\BarcodeTypeEnum;
use ptlis\Barcode\Interfaces\CalculateChecksumInterface;
use ptlis\Barcode\Interfaces\TypeInterface;
use ptlis\Barcode\Interfaces\ValidatorInterface;

abstract class AbstractBarcodeTestCase extends TestCase
{
    abstract public function getValidator(): ValidatorInterface & CalculateChecksumInterface & TypeInterface;

    abstract public function getExpectedType(): BarcodeTypeEnum;

    public function testGetType(): void
    {
        $this->assertEquals($this->getExpectedType(), $this->getValidator()->getType());
    }

    /**
     * @phpstan-return array<string, array{
     *     barcode: string
     * }>
     */
    abstract public static function isValidValidBarcodesProvider(): array;

    /**
     * @dataProvider isValidValidBarcodesProvider
     */
    public function testIsValidValidBarcodes(string $barcode): void
    {
        $this->assertTrue($this->getValidator()->isValid($barcode));
    }

    /**
     * @phpstan-return array<string, array{
     *     barcodeWithoutChecksum: string,
     *     expectChecksum: string
     * }>
     */
    abstract public static function calculateChecksumValidDataProvider(): array;

    /**
     * @dataProvider calculateChecksumValidDataProvider
     */
    public function testCalculateChecksumValidBarcodes(string $barcodeWithoutChecksum, string $expectChecksum): void
    {
        $this->assertEquals($expectChecksum, $this->getValidator()->calculateChecksum($barcodeWithoutChecksum));
    }

    /**
     * @phpstan-return array<string, array{
     *     barcode: string
     * }>
     */
    abstract public static function isValidInvalidBarcodesProvider(): array;

    /**
     * @dataProvider isValidInvalidBarcodesProvider
     */
    public function testIsValidInvalidBarcodes(string $barcode): void
    {
        $this->assertFalse($this->getValidator()->isValid($barcode));
    }

    /**
     * @phpstan-return array<string, array{
     *     barcodeWithoutChecksum: string
     * }>
     */
    abstract public static function calculateChecksumInvalidDataProvider(): array;

    /**
     * @dataProvider calculateChecksumInvalidDataProvider
     */
    public function testCalculateChecksumInvalidBarcodes(string $barcodeWithoutChecksum): void
    {
        $this->assertNull($this->getValidator()->calculateChecksum($barcodeWithoutChecksum));
    }
}
