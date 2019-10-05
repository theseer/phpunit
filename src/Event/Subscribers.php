<?php declare(strict_types = 1);
namespace PHPUnit\Event;

use ArrayIterator;
use Iterator;

class Subscribers {

    private $subscribers = [];

    public function add(Subscriber $subscriber): void {
        foreach($subscriber->wants() as $type) {
            $this->subscribers[$type->asString()][] = $subscriber;
        }
    }

    /**
     * @return Iterator<Subscriber>
     */
    public function for(Type $type): Iterator {
        return new ArrayIterator($this->subscribers[$type->asString()]);
    }
}
