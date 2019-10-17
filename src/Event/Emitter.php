<?php declare(strict_types = 1);
namespace PHPUnit\Event;

class Emitter {

    /** @var Dispatcher */
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function fooEvent($payload): void {
        $this->dispatcher->dispatch(
            new FooEvent($payload)
        );
    }
}
