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
 * @covers \PHPUnit\Event\Test\RunErrored
 */
final class RunErroredTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $test          = $this->createMock(Framework\Test::class);
        $error         = $this->createMock(\Throwable::class);
        $stopOnError   = false;
        $stopOnDefect  = true;

        $event = new RunErrored(
            $telemetryInfo,
            $test,
            $error,
            $stopOnError,
            $stopOnDefect
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($error, $event->error());
        self::assertSame($stopOnError, $event->stopOnError());
        self::assertSame($stopOnDefect, $event->stopOnDefect());
    }
}
