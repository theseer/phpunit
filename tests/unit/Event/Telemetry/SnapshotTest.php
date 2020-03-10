<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Telemetry;

use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\Telemetry\Snapshot
 */
final class SnapshotTest extends TestCase
{
    public function testConstructorSetsValues(): void
    {
        $time            = new \DateTimeImmutable();
        $memoryUsage     = MemoryUsage::fromBytes(2000);
        $peakMemoryUsage = MemoryUsage::fromBytes(3000);

        $snapshot = new Snapshot(
            $time,
            $memoryUsage,
            $peakMemoryUsage
        );

        self::assertSame($time, $snapshot->time());
        self::assertSame($memoryUsage, $snapshot->memoryUsage());
        self::assertSame($peakMemoryUsage, $snapshot->peakMemoryUsage());
    }
}