<?php declare(strict_types = 1);
namespace PHPUnit\Event;

abstract class TemplateSubscriber implements Subscriber {

    public function notify(Event $event): void {
        $this->ensureSupportedEventType($event);
        $this->handle($event);
    }

    private function ensureSupportedEventType(Event $event): void {
        if (!$this->wants()->has($event->type())) {
            throw UnsupportedEvent::type($event->type());
        }
    }

    abstract protected function handle(Event $event): void;

}
