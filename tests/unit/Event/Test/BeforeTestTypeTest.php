<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Test;

use PHPUnit\Event\NamedType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\Test\BeforeTestType
 */
final class BeforeTestTypeTest extends TestCase
{
    public function testAsStringReturnsBeforeTest(): void
    {
        $type = new BeforeTestType();

        self::assertSame('before-test', $type->asString());
    }

    public function testIsReturnsFalseWhenTypeIsDifferentType(): void
    {
        $type = new BeforeTestType();

        $other = new NamedType('foo');

        self::assertFalse($type->is($other));
    }

    public function testIsReturnsTrueWhenTypeIsEqualType(): void
    {
        $type = new BeforeTestType();

        $other = new NamedType('before-test');

        self::assertTrue($type->is($other));
    }
}
