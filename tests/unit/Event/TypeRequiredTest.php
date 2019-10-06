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

use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPUnit\Event\TypeRequired
 */
final class TypeRequiredTest extends TestCase
{
    public function testCreateReturnsTypeRequired(): void
    {
        $exception = TypeRequired::create();

        self::assertInstanceOf(\Exception::class, $exception);
        self::assertInstanceOf(Exception::class, $exception);
        self::assertSame('At least one type needs to be provided.', $exception->getMessage());
    }
}
