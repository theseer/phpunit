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

class SummaryElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, int $testCount, int $assertionCount, ?int $testSuiteCount = null)
    {
        parent::__construct($writer);

        $this->startElement('summary');

        if ($testSuiteCount !== null) {
            $this->writeAttribute('testSuiteCount', (string) $testSuiteCount);
        }

        $this->writeAttribute('testCount', (string) $testCount);
        $this->writeAttribute('assertionCount', (string) $assertionCount);
    }

    public function writeIssuesSummary(int $riskyCount, int $deprecationCount, int $errorCount, int $noticeCount, int $warningCount): void
    {
        $this->startElement('issues');
        $this->writeAttribute('riskyCount', (string) $riskyCount);
        $this->writeAttribute('deprecationCount', (string) $deprecationCount);
        $this->writeAttribute('errorCount', (string) $errorCount);
        $this->writeAttribute('noticeCount', (string) $noticeCount);
        $this->writeAttribute('warningCount', (string) $warningCount);
        $this->done();
    }

    public function writeOutcomeSummary(int $passedCount, int $failedCount, int $erroredCount, int $skippedCount, int $incompleteCount): void
    {
        $this->startElement('outcome');
        $this->writeAttribute('passedCount', (string) $passedCount);
        $this->writeAttribute('failedCount', (string) $failedCount);
        $this->writeAttribute('erroredCount', (string) $erroredCount);
        $this->writeAttribute('skippedCount', (string) $skippedCount);
        $this->writeAttribute('incompleteCount', (string) $incompleteCount);
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
