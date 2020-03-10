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

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\Framework;

final class RunConfigured implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var Framework\Test
     */
    private $test;

    /**
     * @var bool
     */
    private $beStrictAboutOutputDuringTests;

    /**
     * @var bool
     */
    private $beStrictAboutResourceUsageDuringSmallTests;

    /**
     * @var bool
     */
    private $beStrictAboutTestsThatDoNotTestAnything;

    /**
     * @var bool
     */
    private $beStrictAboutTodoAnnotatedTests;

    /**
     * @var bool
     */
    private $convertDeprecationsToExceptions;

    /**
     * @var bool
     */
    private $convertErrorsToExceptions;

    /**
     * @var bool
     */
    private $convertNoticesToExceptions;

    /**
     * @var bool
     */
    private $convertWarningsToExceptions;

    /**
     * @var bool
     */
    private $stopOnDefect;

    /**
     * @var bool
     */
    private $stopOnError;

    /**
     * @var bool
     */
    private $stopOnFailure;

    /**
     * @var bool
     */
    private $stopOnIncomplete;

    /**
     * @var bool
     */
    private $stopOnRisky;

    /**
     * @var bool
     */
    private $stopOnSkipped;

    /**
     * @var bool
     */
    private $stopOnWarning;

    /**
     * @var int
     */
    private $timeoutForLargeTests;

    /**
     * @var int
     */
    private $timeoutForMediumTests;

    /**
     * @var int
     */
    private $timeoutForSmallTests;

    /**
     * @var bool
     */
    private $enforceTimeLimit;

    /**
     * @var int
     */
    private $timeout;

    /**
     * @var bool
     */
    private $collectCodeCoverage;

    /**
     * @var bool
     */
    private $monitorFunctions;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\Test $test,
        bool $beStrictAboutOutputDuringTests,
        bool $beStrictAboutResourceUsageDuringSmallTests,
        bool $beStrictAboutTestsThatDoNotTestAnything,
        bool $beStrictAboutTodoAnnotatedTests,
        bool $convertDeprecationsToExceptions,
        bool $convertErrorsToExceptions,
        bool $convertNoticesToExceptions,
        bool $convertWarningsToExceptions,
        bool $stopOnDefect,
        bool $stopOnError,
        bool $stopOnFailure,
        bool $stopOnIncomplete,
        bool $stopOnRisky,
        bool $stopOnSkipped,
        bool $stopOnWarning,
        int $timeoutForLargeTests,
        int $timeoutForMediumTests,
        int $timeoutForSmallTests,
        bool $enforceTimeLimit,
        int $timeout,
        bool $collectCodeCoverage,
        bool $monitorFunctions
    ) {
        $this->telemetryInfo                              = $telemetryInfo;
        $this->test                                       = $test;
        $this->beStrictAboutOutputDuringTests             = $beStrictAboutOutputDuringTests;
        $this->beStrictAboutResourceUsageDuringSmallTests = $beStrictAboutResourceUsageDuringSmallTests;
        $this->beStrictAboutTestsThatDoNotTestAnything    = $beStrictAboutTestsThatDoNotTestAnything;
        $this->beStrictAboutTodoAnnotatedTests            = $beStrictAboutTodoAnnotatedTests;
        $this->convertDeprecationsToExceptions            = $convertDeprecationsToExceptions;
        $this->convertErrorsToExceptions                  = $convertErrorsToExceptions;
        $this->convertNoticesToExceptions                 = $convertNoticesToExceptions;
        $this->convertWarningsToExceptions                = $convertWarningsToExceptions;
        $this->stopOnDefect                               = $stopOnDefect;
        $this->stopOnError                                = $stopOnError;
        $this->stopOnFailure                              = $stopOnFailure;
        $this->stopOnIncomplete                           = $stopOnIncomplete;
        $this->stopOnRisky                                = $stopOnRisky;
        $this->stopOnSkipped                              = $stopOnSkipped;
        $this->stopOnWarning                              = $stopOnWarning;
        $this->timeoutForLargeTests                       = $timeoutForLargeTests;
        $this->timeoutForMediumTests                      = $timeoutForMediumTests;
        $this->timeoutForSmallTests                       = $timeoutForSmallTests;
        $this->enforceTimeLimit                           = $enforceTimeLimit;
        $this->timeout                                    = $timeout;
        $this->collectCodeCoverage                        = $collectCodeCoverage;
        $this->monitorFunctions                           = $monitorFunctions;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Framework\Test
    {
        return $this->test;
    }

    public function beStrictAboutOutputDuringTests(): bool
    {
        return $this->beStrictAboutOutputDuringTests;
    }

    public function beStrictAboutResourceUsageDuringSmallTests(): bool
    {
        return $this->beStrictAboutResourceUsageDuringSmallTests;
    }

    public function beStrictAboutTestsThatDoNotTestAnything(): bool
    {
        return $this->beStrictAboutTestsThatDoNotTestAnything;
    }

    public function beStrictAboutTodoAnnotatedTests(): bool
    {
        return $this->beStrictAboutTodoAnnotatedTests;
    }

    public function convertDeprecationsToExceptions(): bool
    {
        return $this->convertDeprecationsToExceptions;
    }

    public function convertErrorsToExceptions(): bool
    {
        return $this->convertErrorsToExceptions;
    }

    public function convertNoticesToExceptions(): bool
    {
        return $this->convertNoticesToExceptions;
    }

    public function convertWarningsToExceptions(): bool
    {
        return $this->convertWarningsToExceptions;
    }

    public function stopOnDefect(): bool
    {
        return $this->stopOnDefect;
    }

    public function stopOnError(): bool
    {
        return $this->stopOnError;
    }

    public function stopOnFailure(): bool
    {
        return $this->stopOnFailure;
    }

    public function stopOnIncomplete(): bool
    {
        return $this->stopOnIncomplete;
    }

    public function stopOnRisky(): bool
    {
        return $this->stopOnRisky;
    }

    public function stopOnSkipped(): bool
    {
        return $this->stopOnSkipped;
    }

    public function stopOnWarning(): bool
    {
        return $this->stopOnWarning;
    }

    public function timeoutForLargeTests(): int
    {
        return $this->timeoutForLargeTests;
    }

    public function timeoutForMediumTests(): int
    {
        return $this->timeoutForMediumTests;
    }

    public function timeoutForSmallTests(): int
    {
        return $this->timeoutForSmallTests;
    }

    public function enforceTimeLimit(): bool
    {
        return $this->enforceTimeLimit;
    }

    public function timeout(): int
    {
        return $this->timeout;
    }

    public function collectCodeCoverage(): bool
    {
        return $this->collectCodeCoverage;
    }

    public function monitorFunctions(): bool
    {
        return $this->monitorFunctions;
    }
}
