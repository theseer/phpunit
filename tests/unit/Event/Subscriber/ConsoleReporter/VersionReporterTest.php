<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Subscriber\ConsoleReporter;

use PHPUnit\Event\Execution\BeforeExecution;
use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\Version;
use RecordingPrinter;

/**
 * @covers \PHPUnit\Event\Subscriber\ConsoleReporter\VersionReporter
 */
final class VersionReporterTest extends TestCase
{
    public function testNotifyPrintsVersionString(): void
    {
        $printer = new RecordingPrinter();

        $subscriber = new VersionReporter($printer);

        $subscriber->notify(new BeforeExecution());

        $expected = Version::getVersionString() . \PHP_EOL;

        self::assertSame($expected, $printer->recorded());
    }
}
