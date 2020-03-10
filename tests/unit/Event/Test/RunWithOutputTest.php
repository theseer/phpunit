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
 * @covers \PHPUnit\Event\Test\RunPassed
 */
final class RunWithOutputTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $test          = $this->createMock(Framework\Test::class);
        $error         = new Framework\OutputError();
        $stopOnRisky   = true;
        $stopOnDefect  = false;

        $event = new RunWithOutput(
            $telemetryInfo,
            $test,
            $error,
            $stopOnRisky,
            $stopOnDefect
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($error, $event->error());
        self::assertSame($stopOnRisky, $event->stopOnRisky());
        self::assertSame($stopOnDefect, $event->stopOnDefect());
    }
}
