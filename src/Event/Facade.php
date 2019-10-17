<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event;

class Facade
{
    /** @var TypeMap */
    private $typeMap;

    /** @var Emitter */
    private $emitter;

    public function registerTypeMapping(string $subscriberInterface, string $eventClass): void
    {
        $this->typeMap()->addMapping($subscriberInterface, $eventClass);
    }

    public function emitter(): Emitter
    {
        if ($this->emitter === null) {
            $this->emitter = new Emitter(
                new Dispatcher(
                    $this->typeMap()
                )
            );
        }

        return $this->emitter;
    }

    private function typeMap(): TypeMap
    {
        if ($this->typeMap === null) {
            $this->typeMap = new TypeMap();
        }

        return $this->typeMap;
    }
}
