<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PharIo\Manifest;
use PHPUnit\Framework;
use PHPUnit\TextUI;

final class NullEmitter implements \PHPUnit\Event\Emitter
{
    public function applicationConfigured(Framework\Test $test, array $arguments): void
    {
    }

    public function applicationStarted(array $argv, bool $exit): void
    {
    }

    public function assertionMade(): void
    {
    }

    public function bootstrapFinished(string $filename, string $resolvedFilename): void
    {
    }

    public function bootstrapStarted(string $filename): void
    {
    }

    public function comparatorRegistered(): void
    {
    }

    public function configurationLoaded(TextUI\Configuration\Configuration $configuration): void
    {
    }

    public function extensionLoaded(Manifest\Manifest $manifest): void
    {
    }

    public function globalStateCaptured(): void
    {
    }

    public function globalStateModified(): void
    {
    }

    public function globalStateRestored(): void
    {
    }

    public function testAfterClassFinished(): void
    {
    }

    public function testBeforeClassFinished(): void
    {
    }

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
    ): void {
    }

    public function testRunErrored(Framework\Test $test, \Throwable $error, float $time, bool $stopOnError, bool $stopOnFailure): void
    {
    }

    public function testRunFailed(Framework\Test $test, Framework\AssertionFailedError $error, float $time, bool $stopOnFailure, bool $stopOnDefect): void
    {
    }

    public function testRunFinished(Framework\Test  $test, float $time, ?array $coverageData, bool $error, bool $failure, bool $incomplete, bool $risky, bool $skipped, bool $warning): void
    {
    }

    public function testRunIncomplete(Framework\Test $test, Framework\IncompleteTest $error, float $time, bool $stopOnIncomplete): void
    {
    }

    public function testRunRisky(Framework\Test $test, Framework\RiskyTestError $error, float $time, bool $stopOnRisky, bool $stopOnDefect): void
    {
    }

    public function testRunSkipped(Framework\Test $test, Framework\SkippedTest $error, float $time, bool $stopOnSkipped): void
    {
    }

    public function testRunWarning(Framework\Test $test, Framework\Warning $warning, float $time, bool $stopOnWarning, bool $stopOnDefect): void
    {
    }

    public function testRunWithOutput(Framework\Test $test, Framework\OutputError $error, float $time, bool $stopOnRisky, bool $stopOnDefect): void
    {
    }

    public function testSetUpFinished(): void
    {
    }

    public function testTearDownFinished(): void
    {
    }

    public function testDoubleMockCreated(): void
    {
    }

    public function testDoubleMockForTraitCreated(): void
    {
    }

    public function testDoublePartialMockCreated(): void
    {
    }

    public function testDoubleProphecyCreated(): void
    {
    }

    public function testDoubleTestProxyCreated(): void
    {
    }

    public function testSuiteTearDownAfterClassFinished(): void
    {
    }

    public function testSuiteSetUpBeforeClassFinished(): void
    {
    }

    public function testSuiteRunFailed(Framework\TestSuite $testSuite, \Throwable $error): void
    {
    }

    public function testSuiteRunFinished(Framework\TestSuite $testSuite): void
    {
    }

    public function testSuiteRunStarted(Framework\TestSuite $testSuite): void
    {
    }
}
