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

/**
 * @internal
 */
final class Dispatcher
{
    /** @var TypeMap */
    private $typeMap;

    /**
     * @var Subscriber[][]
     */
    private $subscribers = [];

    public function __construct(TypeMap $map)
    {
        $this->typeMap = $map;
    }

    public function register(Subscriber $subscriber): void
    {
        if (!$this->typeMap->isKnownSubscriberType($subscriber)) {
            throw new UnknownSubscriberType(\sprintf(
                'Subscriber "%s" does not implement any known interface - did you forget to register it?',
                \get_class($subscriber)
            ));
        }

        $eventClassName = $this->typeMap->map($subscriber);

        if (!\array_key_exists($eventClassName, $this->subscribers)) {
            $this->subscribers[$eventClassName] = [];
        }

        $this->subscribers[$eventClassName][] = $subscriber;
    }

    public function dispatch(Event $event): void
    {
        $eventClassName = \get_class($event);

        if (!$this->typeMap->isKnownEventType($event)) {
            throw new UnknownEventType(\sprintf(
                'Unknown event type "%s"',
                $eventClassName
            ));
        }

        if (!\array_key_exists($eventClassName, $this->subscribers)) {
            return;
        }

        foreach ($this->subscribers[$eventClassName] as $subscriber) {
            /** @noinspection PhpParamsInspection */
            /** @psalm-suppress UndefinedInterfaceMethod */
            $subscriber->notify($event);
        }
    }
}
