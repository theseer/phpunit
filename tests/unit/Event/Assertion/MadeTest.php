<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Assertion;

use PHPUnit\Event\AbstractEventTestCase;

/**
 * @covers \PHPUnit\Event\Assertion\Made
 */
final class MadeTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $failed        = true;

        $event = new Made(
            $telemetryInfo,
            $failed
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($failed, $event->failed());
    }
}
