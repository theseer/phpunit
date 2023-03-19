<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class EnvironmentElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, string $os, string $hostname, string $username)
    {
        parent::__construct($writer);

        $this->startElement('environment');
        $this->writeAttribute('os', $os);
        $this->writeAttribute('hostname', $hostname);
        $this->writeAttribute('username', $username);
    }

    public function startPHP(string $version): PHPElement
    {
        return new PHPElement($this->writer, $version);
    }

    public function startPHPUnit(string $version, string $installMethod): PHPUnitElement
    {
        return new PHPUnitElement($this->writer, $version, $installMethod);
    }
}
