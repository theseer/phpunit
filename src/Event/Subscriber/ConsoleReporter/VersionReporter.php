<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Subscriber\ConsoleReporter;

use PHPUnit\Event\Execution\BeforeExecution;
use PHPUnit\Event\Execution\BeforeExecutionSubscriber;
use PHPUnit\Runner\Version;
use PHPUnit\TextUI\ResultPrinter;

final class VersionReporter implements BeforeExecutionSubscriber
{
    private $printer;

    public function __construct(ResultPrinter $resultPrinter)
    {
        $this->printer = $resultPrinter;
    }

    public function notify(BeforeExecution $event): void
    {
        $this->printer->write(Version::getVersionString() . \PHP_EOL);
    }
}
