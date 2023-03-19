<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML;

use DateTimeImmutable;
use PHPUnit\Logging\XML\Element\LogElement;
use XMLWriter;

class LogWriter {
    private string $path;

    public function __construct(string $path) {
        $this->path = $path;
    }
    public function start(string $uuid, DateTimeImmutable $timestamp): LogElement {
        $xml = new XMLWriter();
        $xml->openUri($this->path);
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument('1.0', 'utf-8');

        return new LogElement($xml, $uuid, $timestamp);
    }
}
