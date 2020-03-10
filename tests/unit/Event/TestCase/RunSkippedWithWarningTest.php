<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\TestCase;

use PHPUnit\Event\AbstractEventTestCase;
use PHPUnit\Framework;

/**
 * @covers \PHPUnit\Event\TestCase\RunSkippedWithWarning
 */
final class RunSkippedWithWarningTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $testCase      = $this->createMock(Framework\TestCase::class);
        $error         = $this->createMock(\Throwable::class);

        $event = new RunSkippedWithWarning(
            $telemetryInfo,
            $testCase,
            $error
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($testCase, $event->testCase());
        self::assertSame($error, $event->warning());
    }
}
