<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class AbstractElement {

    protected readonly XMLWriter $writer;

    public function __construct(XMLWriter $writer) {
        $this->writer = $writer;
    }

    protected function startElement(string $name): void {
        $this->writer->startElement($name);
    }

    protected function writeAttribute(string $name, string $value): void {
        $this->writer->writeAttribute($name, $value);
    }

    public function done(): void {
        $this->writer->endElement();
    }

    protected function writeText(string $message): void {
        $this->writer->text($message);
    }

}
