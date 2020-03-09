<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Arguments;

use PHPUnit\Event\Subscriber;

interface ParsedSubscriber extends Subscriber
{
    public function notify(Parsed $event): void;
}
