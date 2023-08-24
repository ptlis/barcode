<?php

declare(strict_types=1);

namespace ptlis\Tests\BarcodeValidation;

use PHPUnit\Framework\TestCase;
use ptlis\BarcodeValidation\Validator;

/**
 * @covers \ptlis\BarcodeValidation\Validator
 */
final class ValidatorTest extends TestCase
{
    public function testIsValidWithDefaultsIsValid(): void
    {
        $validator = new Validator();

        $this->assertTrue($validator->isValid('45145148'));
    }

    public function testIsValidWithDefaultsIsInvalid(): void
    {
        $validator = new Validator();

        $this->assertFalse($validator->isValid('451451489ss'));
    }
}
