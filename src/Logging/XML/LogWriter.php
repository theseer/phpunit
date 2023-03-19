<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Logging\XML;

use DateTimeImmutable;
use PHPUnit\Logging\XML\Element\LogElement;
use XMLWriter;

class LogWriter
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function start(string $uuid, DateTimeImmutable $timestamp): LogElement
    {
        $xml = new XMLWriter;
        $xml->openUri($this->path);
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument('1.0', 'utf-8');

        return new LogElement($xml, $uuid, $timestamp);
    }
}
