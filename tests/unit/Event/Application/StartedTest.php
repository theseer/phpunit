<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Application;

use PHPUnit\Event\AbstractEventTestCase;

/**
 * @covers \PHPUnit\Event\Application\Started
 */
final class StartedTest extends AbstractEventTestCase
{
    /**
     * @dataProvider provideBoolean
     */
    public function testConstructorSetsValues(bool $exit): void
    {
        $telemetryInfo = self::createTelemetryInfo();
        $argv          = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];

        $event = new Started(
            $telemetryInfo,
            $argv,
            $exit
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($argv, $event->argv());
        self::assertSame($exit, $event->exit());
    }

    public function provideBoolean(): array
    {
        return [
            'bool-false' => [false],
            'bool-true'  => [true],
        ];
    }
}
