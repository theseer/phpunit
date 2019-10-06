<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\TestSuite;

use PHPUnit\Event\Event;
use PHPUnit\Event\Type;

final class BeforeTestSuite implements Event
{
    private $testSuite;

    public function __construct(TestSuite $testSuite)
    {
        $this->testSuite = $testSuite;
    }

    public function type(): Type
    {
        return new BeforeTestSuiteType();
    }

    public function testSuite(): TestSuite
    {
        return $this->testSuite;
    }
}
