<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

use DateTimeImmutable;
use DateTimeInterface;

class LogElement extends AbstractElement {

    private const XMLNS = 'https://schema.phpunit.de/log/1.0';

    public function __construct(\XMLWriter $xml, string $uuid, DateTimeImmutable $timestamp) {
        parent::__construct($xml);

        $this->startElement('log');
        $this->writeAttribute('xmlns', self::XMLNS);
        $this->writeAttribute('id', $uuid);
        $this->writeAttribute('timestamp', $timestamp->format(DateTimeInterface::ATOM));
    }

    public function startEnvironment(string $os, string $hostname, string $username): EnvironmentElement {
        return new EnvironmentElement($this->writer, $os, $hostname, $username);
    }

    public function startConfiguration(): ConfigurationElement {
        return new ConfigurationElement($this->writer);
    }

    public function startTestSuite(string $name): TestSuiteElement {
        return new TestSuiteElement($this->writer, $name);
    }

    public function startSummary(int $testSuiteCount, int $testCount, int $assertionCount): SummaryElement {
        return new SummaryElement($this->writer, $testCount, $assertionCount, $testSuiteCount);
    }

    public function done(): void {
        $this->writer->endDocument();
        $this->writer->flush();
    }

}


