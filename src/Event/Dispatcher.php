<?php declare(strict_types = 1);
namespace PHPUnit\Event;

final class Dispatcher {

    private $subscribers;

    public function __construct() {
        $this->subscribers = new Subscribers();
    }

    public function register(Subscriber $subscriber): void {
        $this->subscribers->add($subscriber);
    }

    public function dispatch(Event $event): void {
        foreach($this->subscribers->for($event->type()) as $subscriber) {
            $subscriber->notify($event);
        }
    }

}
