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
 * @covers \PHPUnit\Event\Test\RunFailed
 */
final class RunFailedTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo   = self::createTelemetryInfo();
        $test            = $this->createMock(Framework\Test::class);
        $error           = new Framework\AssertionFailedError();
        $time            = 123.45;
        $stopOnFailure   = false;
        $stopOnDefect    = true;

        $event = new RunFailed(
            $telemetryInfo,
            $test,
            $error,
            $time,
            $stopOnFailure,
            $stopOnDefect
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($error, $event->error());
        self::assertSame($time, $event->time());
        self::assertSame($stopOnFailure, $event->stopOnFailure());
        self::assertSame($stopOnDefect, $event->stopOnDefect());
    }
}
