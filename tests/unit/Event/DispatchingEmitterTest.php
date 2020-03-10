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

/**
 * @covers \PHPUnit\Event\DispatchingEmitter
 */
final class DispatchingEmitterTest extends Framework\TestCase
{
    public function testApplicationConfiguredDispatchesApplicationConfiguredEvent(): void
    {
        $subscriber = $this->createMock(Application\ConfiguredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Application\Configured::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Application\ConfiguredSubscriber::class,
            Application\Configured::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->applicationConfigured();
    }

    public function testApplicationStartedDispatchesApplicationStartedEvent(): void
    {
        $argv = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];
        $exit = false;

        $subscriber = $this->createMock(Application\StartedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Application\Started $event) use ($argv, $exit): bool {
                self::assertSame($argv, $event->argv());
                self::assertSame($exit, $event->exit());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Application\StartedSubscriber::class,
            Application\Started::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->applicationStarted(
            $argv,
            $exit
        );
    }

    public function testAssertionMadeDispatchesAssertionMadeEvent(): void
    {
        $subscriber = $this->createMock(Assertion\MadeSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Assertion\Made::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Assertion\MadeSubscriber::class,
            Assertion\Made::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->assertionMade();
    }

    public function testBootstrapFinishedDispatchesBootstrapFinishedEvent(): void
    {
        $subscriber = $this->createMock(Bootstrap\FinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Bootstrap\Finished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Bootstrap\FinishedSubscriber::class,
            Bootstrap\Finished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->bootstrapFinished();
    }

    public function testComparatorRegisteredDispatchesComparatorRegisteredEvent(): void
    {
        $subscriber = $this->createMock(Comparator\RegisteredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Comparator\Registered::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Comparator\RegisteredSubscriber::class,
            Comparator\Registered::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->comparatorRegistered();
    }

    public function testConfigurationLoadedDispatchesConfigurationLoadedEvent(): void
    {
        $loader = new TextUI\Configuration\Loader();

        $configuration = $loader->load(__DIR__ . '/../../../phpunit.xml');

        $subscriber = $this->createMock(Configuration\LoadedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Configuration\Loaded $event) use ($configuration): bool {
                self::assertSame($configuration, $event->configuration());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Configuration\LoadedSubscriber::class,
            Configuration\Loaded::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->configurationLoaded($configuration);
    }

    public function testExtensionLoadedDispatchesExtensionLoadedEvent(): void
    {
        $subscriber = $this->createMock(Extension\LoadedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Extension\Loaded::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Extension\LoadedSubscriber::class,
            Extension\Loaded::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->extensionLoaded();
    }

    public function testGlobalStateCapturedDispatchesGlobalStateCapturedEvent(): void
    {
        $subscriber = $this->createMock(GlobalState\CapturedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(GlobalState\Captured::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            GlobalState\CapturedSubscriber::class,
            GlobalState\Captured::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->globalStateCaptured();
    }

    public function testGlobalStateModifiedDispatchesGlobalStateModifiedEvent(): void
    {
        $subscriber = $this->createMock(GlobalState\ModifiedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(GlobalState\Modified::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            GlobalState\ModifiedSubscriber::class,
            GlobalState\Modified::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->globalStateModified();
    }

    public function testGlobalStateRestoredDispatchesGlobalStateRestoredEvent(): void
    {
        $subscriber = $this->createMock(GlobalState\RestoredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(GlobalState\Restored::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            GlobalState\RestoredSubscriber::class,
            GlobalState\Restored::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->globalStateRestored();
    }

    public function testTestRunConfiguredDispatchesTestRunConfiguredEvent(): void
    {
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

        $subscriber = $this->createMock(Test\RunConfiguredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunConfigured $event) use (
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
            ): bool {
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

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunConfiguredSubscriber::class,
            Test\RunConfigured::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunConfigured(
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
    }

    public function testTestRunErroredDispatchesTestRunErroredEvent(): void
    {
        $test        = $this->createMock(Framework\Test::class);
        $error       = $this->createMock(\Throwable::class);
        $time        = 123.45;
        $stopOnError = false;
        $stopOnDefect= true;

        $subscriber = $this->createMock(Test\RunErroredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunErrored $event) use ($test, $error, $time, $stopOnError, $stopOnDefect): bool {
                self::assertSame($test, $event->test());
                self::assertSame($error, $event->error());
                self::assertSame($time, $event->time());
                self::assertSame($stopOnError, $event->stopOnError());
                self::assertSame($stopOnDefect, $event->stopOnDefect());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunErroredSubscriber::class,
            Test\RunErrored::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunErrored(
            $test,
            $error,
            $time,
            $stopOnError,
            $stopOnDefect
        );
    }

    public function testTestRunFailedDispatchesTestRunFailedEvent(): void
    {
        $subscriber = $this->createMock(Test\RunFailedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunFailed::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunFailedSubscriber::class,
            Test\RunFailed::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunFailed();
    }

    public function testTestRunFinishedDispatchesTestRunFinishedEvent(): void
    {
        $subscriber = $this->createMock(Test\RunFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunFinishedSubscriber::class,
            Test\RunFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunFinished();
    }

    public function testTestRunIncompleteDispatchesTestRunIncompleteEvent(): void
    {
        $test             = $this->createMock(Framework\Test::class);
        $error            = $this->createMock(Framework\IncompleteTest::class);
        $time             = 123.45;
        $stopOnIncomplete = false;

        $subscriber = $this->createMock(Test\RunIncompleteSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunIncomplete $event) use ($test, $error, $time, $stopOnIncomplete): bool {
                self::assertSame($test, $event->test());
                self::assertSame($error, $event->error());
                self::assertSame($time, $event->time());
                self::assertSame($stopOnIncomplete, $event->stopOnIncomplete());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunIncompleteSubscriber::class,
            Test\RunIncomplete::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunIncomplete(
            $test,
            $error,
            $time,
            $stopOnIncomplete
        );
    }

    public function testTestRunRiskyDispatchesTestRunRiskyEvent(): void
    {
        $test         = $this->createMock(Framework\Test::class);
        $error        = new Framework\RiskyTestError();
        $time         = 123.45;
        $stopOnRisky  = false;
        $stopOnDefect = true;

        $subscriber = $this->createMock(Test\RunRiskySubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunRisky $event) use ($test, $error, $time, $stopOnRisky, $stopOnDefect): bool {
                self::assertSame($test, $event->test());
                self::assertSame($error, $event->error());
                self::assertSame($time, $event->time());
                self::assertSame($stopOnRisky, $event->stopOnRisky());
                self::assertSame($stopOnDefect, $event->stopOnDefect());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunRiskySubscriber::class,
            Test\RunRisky::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunRisky(
            $test,
            $error,
            $time,
            $stopOnRisky,
            $stopOnDefect
        );
    }

    public function testTestRunSkippedDispatchesTestRunSkippedEvent(): void
    {
        $test          = $this->createMock(Framework\Test::class);
        $error         = $this->createMock(Framework\SkippedTest::class);
        $time          = 123.45;
        $stopOnSkipped = false;

        $subscriber = $this->createMock(Test\RunSkippedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunSkipped $event) use ($test, $error, $time, $stopOnSkipped): bool {
                self::assertSame($test, $event->test());
                self::assertSame($error, $event->error());
                self::assertSame($time, $event->time());
                self::assertSame($stopOnSkipped, $event->stopOnSkipped());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunSkippedSubscriber::class,
            Test\RunSkipped::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunSkipped(
            $test,
            $error,
            $time,
            $stopOnSkipped
        );
    }

    public function testTestRunSkippedByDataProviderDispatchesTestRunSkippedByDataProviderEvent(): void
    {
        $subscriber = $this->createMock(Test\RunSkippedByDataProviderSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunSkippedByDataProvider::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunSkippedByDataProviderSubscriber::class,
            Test\RunSkippedByDataProvider::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunSkippedByDataProvider();
    }

    public function testTestRunSkippedWithFailedRequirementsDispatchesTestRunSkippedWithFailedRequirementsEvent(): void
    {
        $subscriber = $this->createMock(Test\RunSkippedWithFailedRequirementsSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunSkippedWithFailedRequirements::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunSkippedWithFailedRequirementsSubscriber::class,
            Test\RunSkippedWithFailedRequirements::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunSkippedWithFailedRequirements();
    }

    public function testTestRunWarningDispatchesTestRunWarningEvent(): void
    {
        $test          = $this->createMock(Framework\Test::class);
        $warning       = new Framework\Warning();
        $time          = 123.45;
        $stopOnWarning = false;
        $stopOnDefect  = true;

        $subscriber = $this->createMock(Test\RunWarningSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunWarning $event) use ($test, $warning, $time, $stopOnWarning, $stopOnDefect): bool {
                self::assertSame($test, $event->test());
                self::assertSame($warning, $event->warning());
                self::assertSame($time, $event->time());
                self::assertSame($stopOnWarning, $event->stopOnWarning());
                self::assertSame($stopOnDefect, $event->stopOnDefect());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunWarningSubscriber::class,
            Test\RunWarning::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunWarning(
            $test,
            $warning,
            $time,
            $stopOnWarning,
            $stopOnDefect
        );
    }

    public function testTestRunWithOutputDispatchesTestRunWithOutputEvent(): void
    {
        $test         = $this->createMock(Framework\Test::class);
        $error        = new Framework\OutputError();
        $time         = 123.45;
        $stopOnRisky  = true;
        $stopOnDefect = false;

        $subscriber = $this->createMock(Test\RunWithOutputSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunWithOutput $event) use ($test, $error, $time, $stopOnRisky, $stopOnDefect): bool {
                self::assertSame($test, $event->test());
                self::assertSame($error, $event->error());
                self::assertSame($time, $event->time());
                self::assertSame($stopOnRisky, $event->stopOnRisky());
                self::assertSame($stopOnDefect, $event->stopOnDefect());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunWithOutputSubscriber::class,
            Test\RunWithOutput::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunWithOutput(
            $test,
            $error,
            $time,
            $stopOnRisky,
            $stopOnDefect
        );
    }

    public function testTestSetUpBeforeClassFinishedDispatchesTestSetUpBeforeClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(Test\SetUpBeforeClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\SetUpBeforeClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\SetUpBeforeClassFinishedSubscriber::class,
            Test\SetUpBeforeClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSetUpBeforeClassFinished();
    }

    public function testTestSetUpFinishedDispatchesTestSetUpFinishedEvent(): void
    {
        $subscriber = $this->createMock(Test\SetUpFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\SetUpFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\SetUpFinishedSubscriber::class,
            Test\SetUpFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSetUpFinished();
    }

    public function testTestTearDownAfterClassFinishedDispatchesTestCaseTearDownAfterClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(Test\TearDownAfterClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\TearDownAfterClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\TearDownAfterClassFinishedSubscriber::class,
            Test\TearDownAfterClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testTearDownAfterClassFinished();
    }

    public function testTestTearDownFinishedDispatchesTestTearDownFinishedEvent(): void
    {
        $subscriber = $this->createMock(Test\TearDownFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\TearDownFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\TearDownFinishedSubscriber::class,
            Test\TearDownFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testTearDownFinished();
    }

    public function testTestDoubleMockCreatedDispatchesTestDoubleMockCreatedEvent(): void
    {
        $subscriber = $this->createMock(TestDouble\MockCreatedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestDouble\MockCreated::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestDouble\MockCreatedSubscriber::class,
            TestDouble\MockCreated::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testDoubleMockCreated();
    }

    public function testTestDoubleMockForTraitCreatedDispatchesTestDoubleMockForTraitCreatedEvent(): void
    {
        $subscriber = $this->createMock(TestDouble\MockForTraitCreatedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestDouble\MockForTraitCreated::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestDouble\MockForTraitCreatedSubscriber::class,
            TestDouble\MockForTraitCreated::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testDoubleMockForTraitCreated();
    }

    public function testTestDoublePartialMockCreatedDispatchesTestDoublePartialMockCreatedEvent(): void
    {
        $subscriber = $this->createMock(TestDouble\PartialMockCreatedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestDouble\PartialMockCreated::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestDouble\PartialMockCreatedSubscriber::class,
            TestDouble\PartialMockCreated::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testDoublePartialMockCreated();
    }

    public function testTestDoubleProphecyCreatedDispatchesTestDoubleProphecyCreatedEvent(): void
    {
        $subscriber = $this->createMock(TestDouble\ProphecyCreatedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestDouble\ProphecyCreated::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestDouble\ProphecyCreatedSubscriber::class,
            TestDouble\ProphecyCreated::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testDoubleProphecyCreated();
    }

    public function testTestDoubleTestProxyCreatedDispatchesTestDoubleTestProxyCreatedEvent(): void
    {
        $subscriber = $this->createMock(TestDouble\TestProxyCreatedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestDouble\TestProxyCreated::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestDouble\TestProxyCreatedSubscriber::class,
            TestDouble\TestProxyCreated::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testDoubleTestProxyCreated();
    }

    public function testTestSuiteAfterClassFinishedDispatchesTestSuiteAfterClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestSuite\AfterClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestSuite\AfterClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\AfterClassFinishedSubscriber::class,
            TestSuite\AfterClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteAfterClassFinished();
    }

    public function testTestSuiteBeforeClassFinishedDispatchesTestSuiteBeforeClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestSuite\BeforeClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestSuite\BeforeClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\BeforeClassFinishedSubscriber::class,
            TestSuite\BeforeClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteBeforeClassFinished();
    }

    public function testTestSuiteConfiguredDispatchesTestSuiteConfiguredEvent(): void
    {
        $subscriber = $this->createMock(TestSuite\ConfiguredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestSuite\Configured::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\ConfiguredSubscriber::class,
            TestSuite\Configured::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteConfigured();
    }

    public function testTestSuiteRunFinishedDispatchesTestSuiteRunFinishedEvent(): void
    {
        $testSuite = new Framework\TestSuite();

        $subscriber = $this->createMock(TestSuite\RunFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (TestSuite\RunFinished $event) use ($testSuite): bool {
                self::assertSame($testSuite, $event->testSuite());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\RunFinishedSubscriber::class,
            TestSuite\RunFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteRunFinished($testSuite);
    }

    public function testTestSuiteRunStartedDispatchesTestSuiteRunStartedEvent(): void
    {
        $testSuite = new Framework\TestSuite();

        $subscriber = $this->createMock(TestSuite\RunStartedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (TestSuite\RunStarted $event) use ($testSuite): bool {
                self::assertSame($testSuite, $event->testSuite());

                return true;
            }));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\RunStartedSubscriber::class,
            TestSuite\RunStarted::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteRunStarted($testSuite);
    }

    private static function createDispatcherWithRegisteredSubscriber(string $subscriberInterface, string $eventClass, Subscriber $subscriber): Dispatcher
    {
        $typeMap = new TypeMap();

        $typeMap->addMapping(
            $subscriberInterface,
            $eventClass
        );

        $dispatcher = new Dispatcher($typeMap);

        $dispatcher->register($subscriber);

        return $dispatcher;
    }

    private static function createTelemetrySystem(): Telemetry\System
    {
        return new Telemetry\System(
            new Telemetry\SystemClock(new \DateTimeZone('Europe/Berlin')),
            new Telemetry\SystemMemoryMeter()
        );
    }
}
