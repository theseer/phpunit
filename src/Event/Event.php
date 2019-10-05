<?php declare(strict_types = 1);
namespace PHPUnit\Event;

interface Event {
    public function type(): Type;
}
