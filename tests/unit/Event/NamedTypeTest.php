<?php

declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event;

use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\NamedType
 */
final class NamedTypeTest extends TestCase
{
    public function testConstructorSetsName(): void
    {
        $name = 'foo';

        $type = new NamedType($name);

        self::assertSame($name, $type->asString());
    }

    public function testIsReturnsFalseWhenNameIsNotSame(): void
    {
        $type  = new NamedType('foo');
        $other = new NamedType('bar');

        self::assertFalse($type->is($other));
    }

    public function testIsReturnsFalseWhenNameIsSame(): void
    {
        $type  = new NamedType('foo');
        $other = new NamedType('foo');

        self::assertTrue($type->is($other));
    }
}
