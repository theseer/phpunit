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
 * @covers \PHPUnit\Event\Test\RunWarning
 */
final class RunWarningTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $test          = $this->createMock(Framework\Test::class);
        $warning       = new Framework\Warning();
        $stopOnWarning = false;
        $stopOnDefect  = true;

        $event = new RunWarning(
            $telemetryInfo,
            $test,
            $warning,
            $stopOnWarning,
            $stopOnDefect
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($warning, $event->warning());
        self::assertSame($stopOnWarning, $event->stopOnWarning());
        self::assertSame($stopOnDefect, $event->stopOnDefect());
    }
}
