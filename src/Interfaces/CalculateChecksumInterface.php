<?php

declare(strict_types=1);

namespace ptlis\BarcodeValidation\Interfaces;

interface CalculateChecksumInterface
{
    public function calculateChecksum(string $barcodeWithoutChecksum): ?string;
}
