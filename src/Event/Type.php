<?php declare(strict_types = 1);
namespace PHPUnit\Event;

interface Type {
    public function is(Type $other): bool;
    public function asString(): string;
}
