<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation;

use ptlis\BarcodeValidation\Barcodes\EAN13;
use ptlis\BarcodeValidation\Barcodes\EAN8;
use ptlis\BarcodeValidation\Barcodes\UPCA;
use ptlis\BarcodeValidation\Interfaces\TypeInterface;
use ptlis\BarcodeValidation\Interfaces\ValidatorInterface;

final readonly class Validator implements ValidatorInterface
{
    /** @phpstan-var array<value-of<BarcodeTypeEnum>, ValidatorInterface&TypeInterface> */
    private array $validators;

    /**
     * @phpstan-param array<ValidatorInterface&TypeInterface> $validators
     */
    public function __construct(
        array $validators = []
    ) {
        $mappedValidators = [];

        // If no override is specified then default to the validators for most common barcode formats
        if (!count($validators)) {
            $validators = [
                new EAN8(),
                new EAN13(),
                new UPCA(),
            ];
        }

        foreach ($validators as $validator) {
            $mappedValidators[$validator->getType()->value] = $validator;
        }
        $this->validators = $mappedValidators;
    }

    public function isValid(string $barcode): bool
    {
        foreach ($this->validators as $validator) {
            if ($validator->isValid($barcode)) {
                return true;
            }
        }

        return false;
    }
}
