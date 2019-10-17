<?php declare(strict_types = 1);
namespace PHPUnit\Event;

class Facade {

    /** @var TypeMap */
    private $typeMap;

    /** @var Emitter */
    private $emitter;

    public function registerTypeMapping(string $subscriberInterface, string $eventClass): void {
        $this->typeMap()->addMapping($subscriberInterface, $eventClass);
    }

    public function emitter(): Emitter {
        if ($this->emitter === null) {
            $this->emitter = new Emitter(
                new Dispatcher(
                    $this->typeMap()
                )
            );
        }

        return $this->emitter;
    }

    private function typeMap(): TypeMap {
        if ($this->typeMap === null) {
            $this->typeMap = new TypeMap();

            $this->typeMap->addMapping(Execution\BeforeExecutionSubscriber::class, Execution\BeforeExecution::class);
            $this->typeMap->addMapping(Run\AfterRunSubscriber::class, Run\AfterRun::class);
            $this->typeMap->addMapping(Run\BeforeRunSubscriber::class, Run\BeforeRun::class);
            $this->typeMap->addMapping(Test\AfterLastTestSubscriber::class, Test\AfterLastTest::class);
            $this->typeMap->addMapping(Test\AfterTestSubscriber::class, Test\AfterTest::class);
            $this->typeMap->addMapping(Test\BeforeFirstTestSubscriber::class, Test\BeforeFirstTest::class);
            $this->typeMap->addMapping(Test\BeforeTestSubscriber::class, Test\BeforeTest::class);
            $this->typeMap->addMapping(TestSuite\AfterTestSuiteSubscriber::class, TestSuite\AfterTestSuite::class);
            $this->typeMap->addMapping(TestSuite\BeforeTestSuiteSubscriber::class, TestSuite\BeforeTestSuite::class);
        }

        return $this->typeMap;
    }
}
