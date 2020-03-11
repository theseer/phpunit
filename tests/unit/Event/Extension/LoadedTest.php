<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Extension;

use PharIo\Manifest;
use PHPUnit\Event\AbstractEventTestCase;

/**
 * @covers \PHPUnit\Event\Extension\Loaded
 */
final class LoadedTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $manifest      = $this->createMock(Manifest\Manifest::class);

        $event = new Loaded(
            $telemetryInfo,
            $manifest
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($manifest, $event->manifest());
    }
}
