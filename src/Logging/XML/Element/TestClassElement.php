<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

class TestClassElement extends AbstractElement {

    public function __construct(\XMLWriter $writer, string $src, int $line, string $name, string $prettyName) {
        parent::__construct($writer);

        $this->startElement('testClass');
        $this->writeAttribute('src', $src);
        $this->writeAttribute('line', (string)$line);
        $this->writeAttribute('name', $name);
        $this->writeAttribute('prettyName', $prettyName);
    }

    public function startTestMethod(int $line, string $name): TestMethodElement {
        return new TestMethodElement($this->writer, $line, $name);
    }

}
