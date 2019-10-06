<?php declare(strict_types = 1);
namespace PHPUnit\Event;

interface SubType extends Type {

    public function super(): Type;

}
