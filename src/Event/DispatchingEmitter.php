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

use PHPUnit\Event\Telemetry\Info;
use PHPUnit\Event\Telemetry\Snapshot;
use PHPUnit\Event\Telemetry\System;
use PHPUnit\Framework;
use PHPUnit\TextUI;

final class DispatchingEmitter implements Emitter
{
    /** @var Dispatcher */
    private $dispatcher;

    /** @var System */
    private $system;

    /** @var Snapshot */
    private $startSnapshot;

    /** @var Snapshot */
    private $previousSnapshot;

    public function __construct(Dispatcher $dispatcher, System $system)
    {
        $this->dispatcher = $dispatcher;
        $this->system     = $system;

        $this->startSnapshot    = $system->snapshot();
        $this->previousSnapshot = $system->snapshot();
    }

    public function applicationConfigured(): void
    {
        $this->dispatcher->dispatch(new Application\Configured($this->telemetryInfo()));
    }

    public function applicationStarted(array $argv, bool $exit): void
    {
        $this->dispatcher->dispatch(new Application\Started(
            $this->telemetryInfo(),
            $argv,
            $exit
        ));
    }

    public function assertionMade(): void
    {
        $this->dispatcher->dispatch(new Assertion\Made($this->telemetryInfo()));
    }

    public function bootstrapFinished(): void
    {
        $this->dispatcher->dispatch(new Bootstrap\Finished($this->telemetryInfo()));
    }

    public function bootstrapStarted(): void
    {
    }

    public function comparatorRegistered(): void
    {
        $this->dispatcher->dispatch(new Comparator\Registered($this->telemetryInfo()));
    }

    public function configurationLoaded(TextUI\Configuration\Configuration $configuration): void
    {
        $this->dispatcher->dispatch(new Configuration\Loaded(
            $this->telemetryInfo(),
            $configuration
        ));
    }

    public function extensionLoaded(): void
    {
        $this->dispatcher->dispatch(new Extension\Loaded($this->telemetryInfo()));
    }

    public function globalStateCaptured(): void
    {
        $this->dispatcher->dispatch(new GlobalState\Captured($this->telemetryInfo()));
    }

    public function globalStateModified(): void
    {
        $this->dispatcher->dispatch(new GlobalState\Modified($this->telemetryInfo()));
    }

    public function globalStateRestored(): void
    {
        $this->dispatcher->dispatch(new GlobalState\Restored($this->telemetryInfo()));
    }

    public function testAfterClassFinished(): void
    {
        $this->dispatcher->dispatch(new Test\AfterClassFinished($this->telemetryInfo()));
    }

    public function testBeforeClassFinished(): void
    {
        $this->dispatcher->dispatch(new Test\BeforeClassFinished($this->telemetryInfo()));
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
        $this->dispatcher->dispatch(new Test\RunConfigured(
            $this->telemetryInfo(),
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
        ));
    }

    public function testRunErrored(Framework\Test $test, \Throwable $error, float $time, bool $stopOnError, bool $stopOnFailure): void
    {
        $this->dispatcher->dispatch(new Test\RunErrored(
            $this->telemetryInfo(),
            $test,
            $error,
            $time,
            $stopOnError,
            $stopOnFailure
        ));
    }

    public function testRunFailed(): void
    {
        $this->dispatcher->dispatch(new Test\RunFailed($this->telemetryInfo()));
    }

    public function testRunFinished(): void
    {
        $this->dispatcher->dispatch(new Test\RunFinished($this->telemetryInfo()));
    }

    public function testRunIncomplete(Framework\Test $test, Framework\IncompleteTest $error, float $time, bool $stopOnIncomplete): void
    {
        $this->dispatcher->dispatch(new Test\RunIncomplete(
            $this->telemetryInfo(),
            $test,
            $error,
            $time,
            $stopOnIncomplete
        ));
    }

    public function testRunRisky(Framework\Test $test, Framework\RiskyTestError $error, float $time, bool $stopOnRisky, bool $stopOnDefect): void
    {
        $this->dispatcher->dispatch(new Test\RunRisky(
            $this->telemetryInfo(),
            $test,
            $error,
            $time,
            $stopOnRisky,
            $stopOnDefect
        ));
    }

    public function testRunSkipped(Framework\Test $test, Framework\SkippedTest $error, float $time, bool $stopOnSkipped): void
    {
        $this->dispatcher->dispatch(new Test\RunSkipped(
            $this->telemetryInfo(),
            $test,
            $error,
            $time,
            $stopOnSkipped
        ));
    }

    public function testRunSkippedByDataProvider(): void
    {
        $this->dispatcher->dispatch(new Test\RunSkippedByDataProvider($this->telemetryInfo()));
    }

    public function testRunSkippedWithFailedRequirements(): void
    {
        $this->dispatcher->dispatch(new Test\RunSkippedWithFailedRequirements($this->telemetryInfo()));
    }

    public function testRunWarning(Framework\Test $test, Framework\Warning $warning, float $time, bool $stopOnWarning, bool $stopOnDefect): void
    {
        $this->dispatcher->dispatch(new Test\RunWarning(
            $this->telemetryInfo(),
            $test,
            $warning,
            $time,
            $stopOnWarning,
            $stopOnDefect
        ));
    }

    public function testRunWithOutput(Framework\Test $test, Framework\OutputError $error, float $time, bool $stopOnRisky, bool $stopOnDefect): void
    {
        $this->dispatcher->dispatch(new Test\RunWithOutput(
            $this->telemetryInfo(),
            $test,
            $error,
            $time,
            $stopOnRisky,
            $stopOnDefect
        ));
    }

    public function testSetUpFinished(): void
    {
        $this->dispatcher->dispatch(new Test\SetUpFinished($this->telemetryInfo()));
    }

    public function testTearDownFinished(): void
    {
        $this->dispatcher->dispatch(new Test\TearDownFinished($this->telemetryInfo()));
    }

    public function testCaseSetUpBeforeClassFinished(): void
    {
        $this->dispatcher->dispatch(new TestCase\SetUpBeforeClassFinished($this->telemetryInfo()));
    }

    public function testCaseSetUpFinished(): void
    {
        $this->dispatcher->dispatch(new TestCase\SetUpFinished($this->telemetryInfo()));
    }

    public function testCaseTearDownAfterClassFinished(): void
    {
        $this->dispatcher->dispatch(new TestCase\TearDownAfterClassFinished($this->telemetryInfo()));
    }

    public function testDoubleMockCreated(): void
    {
        $this->dispatcher->dispatch(new TestDouble\MockCreated($this->telemetryInfo()));
    }

    public function testDoubleMockForTraitCreated(): void
    {
        $this->dispatcher->dispatch(new TestDouble\MockForTraitCreated($this->telemetryInfo()));
    }

    public function testDoublePartialMockCreated(): void
    {
        $this->dispatcher->dispatch(new TestDouble\PartialMockCreated($this->telemetryInfo()));
    }

    public function testDoubleProphecyCreated(): void
    {
        $this->dispatcher->dispatch(new TestDouble\ProphecyCreated($this->telemetryInfo()));
    }

    public function testDoubleTestProxyCreated(): void
    {
        $this->dispatcher->dispatch(new TestDouble\TestProxyCreated($this->telemetryInfo()));
    }

    public function testSuiteAfterClassFinished(): void
    {
        $this->dispatcher->dispatch(new TestSuite\AfterClassFinished($this->telemetryInfo()));
    }

    public function testSuiteBeforeClassFinished(): void
    {
        $this->dispatcher->dispatch(new TestSuite\BeforeClassFinished($this->telemetryInfo()));
    }

    public function testSuiteConfigured(): void
    {
        $this->dispatcher->dispatch(new TestSuite\Configured($this->telemetryInfo()));
    }

    public function testSuiteRunFailed(Framework\TestSuite $testSuite, \Throwable $error): void
    {
    }

    public function testSuiteRunFinished(Framework\TestSuite $testSuite): void
    {
        $this->dispatcher->dispatch(new TestSuite\RunFinished(
            $this->telemetryInfo(),
            $testSuite
        ));
    }

    public function testSuiteRunStarted(Framework\TestSuite $testSuite): void
    {
        $this->dispatcher->dispatch(new TestSuite\RunStarted(
            $this->telemetryInfo(),
            $testSuite
        ));
    }

    private function telemetryInfo(): Info
    {
        $current = $this->system->snapshot();

        $info = new Info(
            $current,
            $current->time()->diff($this->startSnapshot->time()),
            $current->memoryUsage()->diff($this->startSnapshot->memoryUsage()),
            $current->time()->diff($this->previousSnapshot->time()),
            $current->memoryUsage()->diff($this->previousSnapshot->memoryUsage())
        );

        $this->previousSnapshot = $current;

        return $info;
    }
}
