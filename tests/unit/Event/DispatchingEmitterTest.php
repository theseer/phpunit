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
        $subscriber = $this->createMock(Test\RunConfiguredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunConfigured::class));

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

        $emitter->testRunConfigured();
    }

    public function testTestRunErroredDispatchesTestRunErroredEvent(): void
    {
        $subscriber = $this->createMock(Test\RunErroredSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunErrored::class));

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

        $emitter->testRunErrored();
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

    public function testTestRunPassedDispatchesTestRunPassedEvent(): void
    {
        $subscriber = $this->createMock(Test\RunPassedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunPassed::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunPassedSubscriber::class,
            Test\RunPassed::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunPassed();
    }

    public function testTestRunRiskyDispatchesTestRunRiskyEvent(): void
    {
        $subscriber = $this->createMock(Test\RunRiskySubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunRisky::class));

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

        $emitter->testRunRisky();
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

    public function testTestRunSkippedIncompleteDispatchesTestRunSkippedIncompleteEvent(): void
    {
        $subscriber = $this->createMock(Test\RunSkippedIncompleteSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunSkippedIncomplete::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            Test\RunSkippedIncompleteSubscriber::class,
            Test\RunSkippedIncomplete::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testRunSkippedIncomplete();
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
        $subscriber = $this->createMock(Test\RunWarningSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(Test\RunWarning::class));

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

        $emitter->testRunWarning();
    }

    public function testTestRunWithOutputDispatchesTestRunWithOutputEvent(): void
    {
        $test         = $this->createMock(Framework\Test::class);
        $error        = new Framework\OutputError();
        $stopOnRisky  = true;
        $stopOnDefect = false;

        $subscriber = $this->createMock(Test\RunWithOutputSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->callback(static function (Test\RunWithOutput $event) use ($test, $error, $stopOnRisky, $stopOnDefect): bool {
                self::assertSame($test, $event->test());
                self::assertSame($error, $event->error());
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
            $stopOnRisky,
            $stopOnDefect
        );
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

    public function testTestCaseAfterClassFinishedDispatchesTestCaseAfterClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestCase\AfterClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestCase\AfterClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestCase\AfterClassFinishedSubscriber::class,
            TestCase\AfterClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testCaseAfterClassFinished();
    }

    public function testTestCaseBeforeClassFinishedDispatchesTestCaseBeforeClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestCase\BeforeClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestCase\BeforeClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestCase\BeforeClassFinishedSubscriber::class,
            TestCase\BeforeClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testCaseBeforeClassFinished();
    }

    public function testTestCaseSetUpBeforeClassFinishedDispatchesTestSetUpBeforeClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestCase\SetUpBeforeClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestCase\SetUpBeforeClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestCase\SetUpBeforeClassFinishedSubscriber::class,
            TestCase\SetUpBeforeClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testCaseSetUpBeforeClassFinished();
    }

    public function testTestCaseSetUpFinishedDispatchesTestCaseSetUpFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestCase\SetUpFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestCase\SetUpFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestCase\SetUpFinishedSubscriber::class,
            TestCase\SetUpFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testCaseSetUpFinished();
    }

    public function testTestCaseTearDownAfterClassFinishedDispatchesTestCaseTearDownAfterClassFinishedEvent(): void
    {
        $subscriber = $this->createMock(TestCase\TearDownAfterClassFinishedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestCase\TearDownAfterClassFinished::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestCase\TearDownAfterClassFinishedSubscriber::class,
            TestCase\TearDownAfterClassFinished::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testCaseTearDownAfterClassFinished();
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

    public function testTestSuiteLoadedDispatchesTestSuiteLoadedEvent(): void
    {
        $subscriber = $this->createMock(TestSuite\LoadedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestSuite\Loaded::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\LoadedSubscriber::class,
            TestSuite\Loaded::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteLoaded();
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

    public function testTestSuiteSortedDispatchesTestSuiteSortedEvent(): void
    {
        $subscriber = $this->createMock(TestSuite\SortedSubscriber::class);

        $subscriber
            ->expects($this->once())
            ->method('notify')
            ->with($this->isInstanceOf(TestSuite\Sorted::class));

        $dispatcher = self::createDispatcherWithRegisteredSubscriber(
            TestSuite\SortedSubscriber::class,
            TestSuite\Sorted::class,
            $subscriber
        );

        $telemetrySystem = self::createTelemetrySystem();

        $emitter = new DispatchingEmitter(
            $dispatcher,
            $telemetrySystem
        );

        $emitter->testSuiteSorted();
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
