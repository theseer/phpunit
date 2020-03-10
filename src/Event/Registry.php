<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event;

use DateTimeZone;
use PHPUnit\Event\Telemetry\System;
use PHPUnit\Event\Telemetry\SystemClock;
use PHPUnit\Event\Telemetry\SystemMemoryMeter;

final class Registry
{
    /** @var null|TypeMap */
    private static $typeMap;

    /** @var null|Emitter */
    private static $emitter;

    /** @var null|Dispatcher */
    private static $dispatcher;

    public static function emitter(): Emitter
    {
        if (self::$emitter === null) {
            self::$emitter = new DispatchingEmitter(
                self::dispatcher(),
                new System(
                    new SystemClock(new DateTimeZone(\date_default_timezone_get())),
                    new SystemMemoryMeter()
                )
            );
        }

        return self::$emitter;
    }

    private static function dispatcher(): Dispatcher
    {
        if (self::$dispatcher === null) {
            self::$dispatcher = new Dispatcher(self::typeMap());
        }

        return self::$dispatcher;
    }

    private static function typeMap(): TypeMap
    {
        if (self::$typeMap === null) {
            self::$typeMap = new TypeMap();
            self::registerDefaultTypes();
        }

        return self::$typeMap;
    }

    private static function registerDefaultTypes(): void
    {
        $defaultEvents = [
            Application\Configured::class,
            Application\Started::class,
            Assertion\Made::class,
            Bootstrap\Finished::class,
            Comparator\Registered::class,
            Configuration\Loaded::class,
            Extension\Loaded::class,
            GlobalState\Captured::class,
            GlobalState\Modified::class,
            GlobalState\Restored::class,
            Test\RunConfigured::class,
            Test\RunErrored::class,
            Test\RunFailed::class,
            Test\RunFinished::class,
            Test\RunIncomplete::class,
            Test\RunRisky::class,
            Test\RunSkipped::class,
            Test\RunSkippedByDataProvider::class,
            Test\RunSkippedWithFailedRequirements::class,
            Test\RunWarning::class,
            Test\SetUpFinished::class,
            Test\TearDownFinished::class,
            TestCase\AfterClassFinished::class,
            TestCase\BeforeClassFinished::class,
            TestCase\SetUpBeforeClassFinished::class,
            TestCase\SetUpFinished::class,
            TestCase\TearDownAfterClassFinished::class,
            TestDouble\MockCreated::class,
            TestDouble\MockForTraitCreated::class,
            TestDouble\PartialMockCreated::class,
            TestDouble\ProphecyCreated::class,
            TestDouble\TestProxyCreated::class,
            TestSuite\AfterClassFinished::class,
            TestSuite\BeforeClassFinished::class,
            TestSuite\Configured::class,
            TestSuite\RunFinished::class,
            TestSuite\RunStarted::class,
        ];

        foreach ($defaultEvents as $eventClass) {
            self::typeMap()->addMapping(
                $eventClass . 'Subscriber',
                $eventClass
            );
        }
    }
}
