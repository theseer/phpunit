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
 * @covers \PHPUnit\Event\Test\RunConfigured
 */
final class RunConfiguredTest extends AbstractEventTestCase
{
    public function testConstructorSetsValues(): void
    {
        $telemetryInfo                              = self::createTelemetryInfo();
        $test                                       = $this->createMock(Framework\Test::class);
        $beStrictAboutOutputDuringTests             = false;
        $beStrictAboutResourceUsageDuringSmallTests = true;
        $beStrictAboutTestsThatDoNotTestAnything    = false;
        $beStrictAboutTodoAnnotatedTests            = true;
        $convertDeprecationsToExceptions            = false;
        $convertErrorsToExceptions                  = true;
        $convertNoticesToExceptions                 = false;
        $convertWarningsToExceptions                = true;
        $stopOnDefect                               = false;
        $stopOnError                                = true;
        $stopOnFailure                              = false;
        $stopOnIncomplete                           = true;
        $stopOnRisky                                = false;
        $stopOnSkipped                              = true;
        $stopOnWarning                              = false;
        $timeoutForLargeTests                       = 100;
        $timeoutForMediumTests                      = 50;
        $timeoutForSmallTests                       = 10;
        $enforceTimeLimit                           = true;
        $timeout                                    = 20;
        $collectCodeCoverage                        = false;
        $monitorFunctions                           = true;

        $event = new RunConfigured(
            $telemetryInfo,
            $test,
            $beStrictAboutOutputDuringTests,
            $beStrictAboutResourceUsageDuringSmallTests,
            $beStrictAboutTestsThatDoNotTestAnything,
            $beStrictAboutTodoAnnotatedTests,
            $convertDeprecationsToExceptions,
            $convertErrorsToExceptions,
            $convertNoticesToExceptions,
            $convertWarningsToExceptions,
            $stopOnDefect,
            $stopOnError,
            $stopOnFailure,
            $stopOnIncomplete,
            $stopOnRisky,
            $stopOnSkipped,
            $stopOnWarning,
            $timeoutForLargeTests,
            $timeoutForMediumTests,
            $timeoutForSmallTests,
            $enforceTimeLimit,
            $timeout,
            $collectCodeCoverage,
            $monitorFunctions
        );

        self::assertSame($telemetryInfo, $event->telemetryInfo());
        self::assertSame($test, $event->test());
        self::assertSame($beStrictAboutOutputDuringTests, $event->beStrictAboutOutputDuringTests());
        self::assertSame($beStrictAboutResourceUsageDuringSmallTests, $event->beStrictAboutResourceUsageDuringSmallTests());
        self::assertSame($beStrictAboutTestsThatDoNotTestAnything, $event->beStrictAboutTestsThatDoNotTestAnything());
        self::assertSame($beStrictAboutTodoAnnotatedTests, $event->beStrictAboutTodoAnnotatedTests());
        self::assertSame($convertDeprecationsToExceptions, $event->convertDeprecationsToExceptions());
        self::assertSame($convertErrorsToExceptions, $event->convertErrorsToExceptions());
        self::assertSame($convertNoticesToExceptions, $event->convertNoticesToExceptions());
        self::assertSame($convertWarningsToExceptions, $event->convertWarningsToExceptions());
        self::assertSame($stopOnDefect, $event->stopOnDefect());
        self::assertSame($stopOnError, $event->stopOnError());
        self::assertSame($stopOnFailure, $event->stopOnFailure());
        self::assertSame($stopOnIncomplete, $event->stopOnIncomplete());
        self::assertSame($stopOnRisky, $event->stopOnRisky());
        self::assertSame($stopOnSkipped, $event->stopOnSkipped());
        self::assertSame($stopOnWarning, $event->stopOnWarning());
        self::assertSame($timeoutForLargeTests, $event->timeoutForLargeTests());
        self::assertSame($timeoutForMediumTests, $event->timeoutForMediumTests());
        self::assertSame($timeoutForSmallTests, $event->timeoutForSmallTests());
        self::assertSame($enforceTimeLimit, $event->enforceTimeLimit());
        self::assertSame($timeout, $event->timeout());
        self::assertSame($collectCodeCoverage, $event->collectCodeCoverage());
        self::assertSame($monitorFunctions, $event->monitorFunctions());
    }
}
