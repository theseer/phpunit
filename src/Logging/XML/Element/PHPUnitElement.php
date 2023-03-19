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

class PHPUnitElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, string $version, string $installationType)
    {
        parent::__construct($writer);

        $this->startElement('phpunit');
        $this->writeAttribute('version', $version);
        $this->writeAttribute('installationType', $installationType);
    }

    public function addExtension(string $bootstrapClass, string $installationType): PHPUnitExtensionElement
    {
        return new PHPUnitExtensionElement($this->writer, $bootstrapClass, $installationType);
    }
}
