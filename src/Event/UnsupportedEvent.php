<?php declare(strict_types = 1);
namespace PHPUnit\Event;

class UnsupportedEvent extends \Exception {

    public static function type(Type $type): self {
        return new self(sprintf('Type "%s" not supported', $type->asString()));
    }
}
