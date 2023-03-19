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

class TestClassElement extends AbstractElement
{
    public function __construct(XMLWriter $writer, string $src, int $line, string $name, string $prettyName)
    {
        parent::__construct($writer);

        $this->startElement('testClass');
        $this->writeAttribute('src', $src);
        $this->writeAttribute('line', (string) $line);
        $this->writeAttribute('name', $name);
        $this->writeAttribute('prettyName', $prettyName);
    }

    public function startTestMethod(int $line, string $name): TestMethodElement
    {
        return new TestMethodElement($this->writer, $line, $name);
    }
}
