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

class RunElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, string $id, string $prettyName, ?string $dataSetName, int $assertionCount, string $outcome)
    {
        parent::__construct($writer);

        $this->startElement('run');

        $this->writeAttribute('id', $id);
        $this->writeAttribute('prettyName', $prettyName);

        if ($dataSetName !== null) {
            $this->writeAttribute('dataSetName', $dataSetName);
        }
        $this->writeAttribute('assertionCount', (string) $assertionCount);
        $this->writeAttribute('outcome', $outcome);
    }

    public function writeRisky(string $message): void
    {
        $this->startElement('risky');
        $this->writeText($message);
        $this->done();
    }

    public function writeDeprection(string $type, string $file, int $line, string $message): void
    {
        $this->startElement('deprecation');
        $this->writeAttribute('type', $type);
        $this->writeAttribute('file', $file);
        $this->writeAttribute('line', (string) $line);
        $this->writeText($message);
        $this->done();
    }

    public function writeError(string $type, string $file, int $line, string $message): void
    {
        $this->startElement('error');
        $this->writeAttribute('type', $type);
        $this->writeAttribute('file', $file);
        $this->writeAttribute('line', (string) $line);
        $this->writeText($message);
        $this->done();
    }

    public function writeNotice(string $type, string $file, int $line, string $message): void
    {
        $this->startElement('notice');
        $this->writeAttribute('type', $type);
        $this->writeAttribute('file', $file);
        $this->writeAttribute('line', (string) $line);
        $this->writeText($message);
        $this->done();
    }

    public function writeWarning(string $type, string $file, int $line, string $message): void
    {
        $this->startElement('warning');
        $this->writeAttribute('type', $type);
        $this->writeAttribute('file', $file);
        $this->writeAttribute('line', (string) $line);
        $this->writeText($message);
        $this->done();
    }

    public function writeReason(string $message): void
    {
        $this->startElement('reason');
        $this->writeText($message);
        $this->done();
    }

    public function writeStubUsage(string $originalType, int $times): void
    {
        $this->startElement('stub');
        $this->writeAttribute('originalType', $originalType);
        $this->writeAttribute('times', (string) $times);
        $this->done();
    }

    public function writeMockUsage(string $originalType, int $times): void
    {
        $this->startElement('mock');
        $this->writeAttribute('originalType', $originalType);
        $this->writeAttribute('times', (string) $times);
        $this->done();
    }

    public function writeTelemetry(string $duration, string $memory): void
    {
        $this->startElement('telemetry');
        $this->writeAttribute('duration', $duration);
        $this->writeAttribute('memory', $memory);
        $this->done();
    }
}
