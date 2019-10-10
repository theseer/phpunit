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

use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\Test\AfterTest
 */
final class AfterTestTest extends TestCase
{
    public function testConstructorSetsValues(): void
    {
        $test = new Test();

        $result = $this->prophesize(Result::class)->reveal();

        $event = new AfterTest(
            $test,
            $result
        );

        self::assertSame($test, $event->test());
        self::assertSame($result, $event->result());
    }
}
