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
 * @covers \PHPUnit\Event\Test\RunIncomplete
 */
final class RunIncompleteTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo    = self::createTelemetryInfo();
        $test             = $this->createMock(Framework\Test::class);
        $error            = $this->createMock(Framework\IncompleteTest::class);
        $time             = 123.45;
        $stopOnIncomplete = false;

        $event = new RunIncomplete(
            $telemetryInfo,
            $test,
            $error,
            $time,
            $stopOnIncomplete
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($error, $event->error());
        self::assertSame($time, $event->time());
        self::assertSame($stopOnIncomplete, $event->stopOnIncomplete());
    }
}
