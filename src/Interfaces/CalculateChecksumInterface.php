<?php

declare(strict_types=1);

namespace ptlis\Barcode\Interfaces;

interface CalculateChecksumInterface
{
    public function calculateChecksum(string $barcodeWithoutChecksum): ?string;
}
