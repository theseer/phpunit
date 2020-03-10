<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Configuration;

use PHPUnit\Event\AbstractEventTestCase;
use PHPUnit\TextUI;

/**
 * @covers \PHPUnit\Event\Configuration\Loaded
 */
final class LoadedTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo = self::createTelemetryInfo();

        $loader = new TextUI\Configuration\Loader();

        $configuration = $loader->load(__DIR__ . '/../../../../phpunit.xml');

        $event = new Loaded(
            $telemetryInfo,
            $configuration
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($configuration, $event->configuration());
    }

    public function provideBoolean(): array
    {
        return [
            'bool-false' => [false],
            'bool-true'  => [true],
        ];
    }
}
