<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\TextUI\DefaultResultPrinter;

final class RecordingPrinter extends DefaultResultPrinter
{
    private $written = '';

    public function write(string $buffer): void
    {
        $this->written .= $buffer;
    }

    public function recorded(): string
    {
        return $this->written;
    }
}
