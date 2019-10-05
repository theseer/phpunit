<?php declare(strict_types = 1);
namespace PHPUnit\Event;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

final class Types implements IteratorAggregate {

    private $types;

    public function __construct(Type ...$types) {
        $this->types = $types;
    }

    /**
     * @return Iterator<Type>
     */
    public function getIterator(): Iterator {
        return new ArrayIterator($this->types);
    }

    public function has(Type $other): bool {
        foreach($this->types as $type) {
            if ($type->is($other)) {
                return true;
            }
        }

        return false;
    }

}
