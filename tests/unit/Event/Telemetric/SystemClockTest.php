<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Telemetric;

use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\Telemetric\SystemClock
 */
final class SystemClockTest extends TestCase
{
    public function testNowReturnsDateTimeImmutable(): void
    {
        $dateTimeZone = new \DateTimeZone('Europe/Berlin');

        $clock = new SystemClock($dateTimeZone);

        $now = $clock->now();

        $expected = new \DateTimeImmutable(
            'now',
            $dateTimeZone
        );

        self::assertEquals($dateTimeZone, $now->getTimezone());
        self::assertLessThan(2, \abs($expected->getTimestamp() - $now->getTimestamp()));
    }
}
