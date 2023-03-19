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

class PHPUnitExtensionElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, string $bootstrapClass, string $installationType)
    {
        parent::__construct($writer);

        $this->startElement('extension');
        $this->writeAttribute('bootstrapClass', $bootstrapClass);
        $this->writeAttribute('installationType', $installationType);
    }

    public function addParameter(string $name, string $value): void
    {
        $this->startElement('parameter');
        $this->writeAttribute('name', $name);
        $this->writeAttribute('value', $value);
        $this->done();
    }
}
