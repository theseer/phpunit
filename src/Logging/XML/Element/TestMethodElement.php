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

class TestMethodElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, int $line, string $name)
    {
        parent::__construct($writer);

        $this->startElement('testMethod');
        $this->writeAttribute('line', (string) $line);
        $this->writeAttribute('name', $name);
    }

    public function startMetadata(): void
    {
        $this->startElement('metadata');
        $this->done();
    }

    public function writeDataProvider(string $src, int $line, string $class, string $method): void
    {
        $this->startElement('dataProvider');
        $this->writeAttribute('src', $src);
        $this->writeAttribute('line', (string) $line);
        $this->writeAttribute('class', $class);
        $this->writeAttribute('method', $method);
        $this->done();
    }

    public function writeDependency(string $src, int $line, string $class, string $method): void
    {
        $this->startElement('dependency');
        $this->writeAttribute('src', $src);
        $this->writeAttribute('line', (string) $line);
        $this->writeAttribute('class', $class);
        $this->writeAttribute('method', $method);
        $this->done();
    }

    public function startRun(string $id, string $prettyName, ?string $dataSetName, int $assertionCount, string $outcome): RunElement
    {
        return new RunElement($this->writer, $id, $prettyName, $dataSetName, $assertionCount, $outcome);
    }
}
