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

use DummySubscriber;
use NamedType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\Subscribers
 */
final class SubscribersTest extends TestCase
{
    public function testForReturnsEmptyIteratorWhenSubscriberForTypeHasNotBeenAdded(): void
    {
        $type = new NamedType('foo');

        $subscribers = new Subscribers();

        $subscribersForType = $subscribers->for($type);

        self::assertIsIterable($subscribersForType);
        self::assertEquals([], \iterator_to_array($subscribersForType));
    }

    public function testForReturnsIteratorWithSubscribersForTypeWhenSubscriberForTypeHaveBeenAdded(): void
    {
        $firstSubscriber = new DummySubscriber(new Types(
            new NamedType('foo'),
            new NamedType('bar')
        ));

        $secondSubscriber = new DummySubscriber(new Types(
            new NamedType('bar'),
            new NamedType('baz')
        ));

        $thirdSubscriber = new DummySubscriber(new Types(new NamedType('qux')));

        $type = new NamedType('bar');

        $subscribers = new Subscribers();

        $subscribers->add($firstSubscriber);
        $subscribers->add($secondSubscriber);
        $subscribers->add($thirdSubscriber);

        $subscribersForType = $subscribers->for($type);

        $expected = [
            $firstSubscriber,
            $secondSubscriber,
        ];

        self::assertIsIterable($subscribersForType);
        self::assertEquals($expected, \iterator_to_array($subscribersForType));
    }
}
