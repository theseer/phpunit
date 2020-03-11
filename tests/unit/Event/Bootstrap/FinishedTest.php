<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Bootstrap;

use PHPUnit\Event\AbstractEventTestCase;

/**
 * @covers \PHPUnit\Event\Bootstrap\Finished
 */
final class FinishedTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo    = self::createTelemetryInfo();
        $filename         = __FILE__;
        $resolvedFilename = 'phpunit.xml';

        $event = new Finished(
            $telemetryInfo,
            $filename,
            $resolvedFilename
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($filename, $event->filename());
        self::assertSame($resolvedFilename, $event->resolvedFilename());
    }
}
