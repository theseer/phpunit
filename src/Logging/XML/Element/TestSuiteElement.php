<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class TestSuiteElement extends AbstractElement {

    public function __construct(XMLWriter $writer, string $name) {
        parent::__construct($writer);

        $this->startElement('testSuite');
        $this->writeAttribute('name', $name);
    }

    public function addTestClass(string $src, int $line, string $name, string $prettyName) {
        return new TestClassElement($this->writer, $src, $line, $name, $prettyName);
    }

    public function startSummary(int $testCount, int $assertionCount): SummaryElement {
        return new SummaryElement($this->writer, $testCount, $assertionCount);
    }
}
