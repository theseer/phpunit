<?php declare(strict_types = 1);
namespace PHPUnit\Event;

abstract class TemplateType implements Type {

    final public function is(Type $other): bool {
        return $this->asString() === $other->asString();
    }

}
