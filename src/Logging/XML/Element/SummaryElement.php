<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class SummaryElement extends AbstractElement {

    public function __construct(XMLWriter $writer, int $testCount, int $assertionCount, ?int $testSuiteCount = null) {
        parent::__construct($writer);

        $this->startElement('summary');
        if ($testSuiteCount !== null) {
            $this->writeAttribute('testSuiteCount', (string)$testSuiteCount);
        }

        $this->writeAttribute('testCount', (string)$testCount);
        $this->writeAttribute('assertionCount', (string)$assertionCount);
    }

    public function writeIssuesSummary(int $riskyCount, int $deprecationCount, int $errorCount, int $noticeCount, int $warningCount) {
        $this->startElement('issues');
        $this->writeAttribute('riskyCount', (string)$riskyCount);
        $this->writeAttribute('deprecationCount', (string)$deprecationCount);
        $this->writeAttribute('errorCount', (string)$errorCount);
        $this->writeAttribute('noticeCount', (string)$noticeCount);
        $this->writeAttribute('warningCount', (string)$warningCount);
        $this->done();
    }

    public function writeOutcomeSummary(int $passedCount, int $failedCount, int $erroredCount, int $skippedCount, int $incompleteCount) {
        $this->startElement('outcome');
        $this->writeAttribute('passedCount', (string)$passedCount);
        $this->writeAttribute('failedCount', (string)$failedCount);
        $this->writeAttribute('erroredCount', (string)$erroredCount);
        $this->writeAttribute('skippedCount', (string)$skippedCount);
        $this->writeAttribute('incompleteCount', (string)$incompleteCount);
        $this->done();
    }

    public function writeTelemetry(string $duration, string $memory) {
        $this->startElement('telemetry');
        $this->writeAttribute('duration', $duration);
        $this->writeAttribute('memory', $memory);
        $this->done();
    }

}
