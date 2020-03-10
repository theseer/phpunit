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

use PHPUnit\Framework;
use PHPUnit\TextUI;

interface Emitter
{
    public function applicationConfigured(): void;

    public function applicationStarted(array $argv, bool $exit): void;

    public function assertionMade(): void;

    public function bootstrapFinished(): void;

    public function bootstrapStarted(): void;

    public function comparatorRegistered(): void;

    public function configurationLoaded(TextUI\Configuration\Configuration $configuration): void;

    public function extensionLoaded(): void;

    public function globalStateCaptured(): void;

    public function globalStateModified(): void;

    public function globalStateRestored(): void;

    public function testAfterClassFinished(): void;

    public function testBeforeClassFinished(): void;

    public function testRunConfigured(
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
    ): void;

    public function testRunErrored(Framework\Test $test, \Throwable $error, float $time, bool $stopOnError, bool $stopOnFailure): void;

    public function testRunFailed(): void;

    public function testRunFinished(): void;

    public function testRunIncomplete(Framework\Test $test, Framework\IncompleteTest $error, float $time, bool $stopOnIncomplete): void;

    public function testRunRisky(Framework\Test $test, Framework\RiskyTestError $error, float $time, bool $stopOnRisky, bool $stopOnDefect): void;

    public function testRunSkipped(Framework\Test $test, Framework\SkippedTest $error, float $time, bool $stopOnSkipped): void;

    public function testRunSkippedByDataProvider(): void;

    public function testRunSkippedWithFailedRequirements(): void;

    public function testRunWarning(Framework\Test $test, Framework\Warning $warning, float $time, bool $stopOnWarning, bool $stopOnDefect): void;

    public function testRunWithOutput(Framework\Test $test, Framework\OutputError $error, float $time, bool $stopOnRisky, bool $stopOnDefect): void;

    public function testSetUpFinished(): void;

    public function testTearDownFinished(): void;

    public function testCaseSetUpBeforeClassFinished(): void;

    public function testCaseTearDownAfterClassFinished(): void;

    public function testDoubleMockCreated(): void;

    public function testDoubleMockForTraitCreated(): void;

    public function testDoublePartialMockCreated(): void;

    public function testDoubleProphecyCreated(): void;

    public function testDoubleTestProxyCreated(): void;

    public function testSuiteAfterClassFinished(): void;

    public function testSuiteBeforeClassFinished(): void;

    public function testSuiteConfigured(): void;

    public function testSuiteRunFailed(Framework\TestSuite $testSuite, \Throwable $error);

    public function testSuiteRunFinished(Framework\TestSuite $testSuite): void;

    public function testSuiteRunStarted(Framework\TestSuite $testSuite): void;
}
