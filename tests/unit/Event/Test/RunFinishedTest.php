<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Test;

use PHPUnit\Event\AbstractEventTestCase;
use PHPUnit\Framework;

/**
 * @covers \PHPUnit\Event\Test\RunFinished
 */
final class RunFinishedTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo   = self::createTelemetryInfo();
        $test            = $this->createMock(Framework\Test::class);
        $time            = 123.45;
        $coverageData    = [];
        $error           = false;
        $failure         = true;
        $incomplete      = false;
        $risky           = false;
        $skipped         = true;
        $warning         = false;

        $event = new RunFinished(
            $telemetryInfo,
            $test,
            $time,
            $coverageData,
            $error,
            $failure,
            $incomplete,
            $risky,
            $skipped,
            $warning
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($time, $event->time());
        self::assertSame($coverageData, $event->coverageData());
        self::assertSame($error, $event->error());
        self::assertSame($failure, $event->failure());
        self::assertSame($incomplete, $event->incomplete());
        self::assertSame($risky, $event->risky());
        self::assertSame($skipped, $event->skipped());
        self::assertSame($warning, $event->warning());
    }
}
