<?php declare(strict_types = 1);
namespace PHPUnit\Event;

interface Subscriber {

    public function wants(): Types;

    /**
     * @throws UnsupportedEvent
     */
    public function notify(Event $event);
}
