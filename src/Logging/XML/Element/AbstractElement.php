<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class AbstractElement
{
    protected readonly XMLWriter $writer;

    public function __construct(XMLWriter $writer)
    {
        $this->writer = $writer;
    }

    public function done(): void
    {
        $this->writer->endElement();
    }

    protected function startElement(string $name): void
    {
        $this->writer->startElement($name);
    }

    protected function writeAttribute(string $name, string $value): void
    {
        $this->writer->writeAttribute($name, $value);
    }

    protected function writeText(string $message): void
    {
        $this->writer->text($message);
    }
}
