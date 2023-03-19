<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

class PHPElement extends AbstractElement {

    public function __construct(\XMLWriter $writer, string $version) {
        parent::__construct($writer);

        $this->startElement('php');
        $this->writeAttribute('version', $version);
    }

    public function addExtension(string $name, string $version): void {
        $this->startElement('extension');
        $this->writeAttribute('name', $name);
        $this->writeAttribute('version', $version);
        $this->done();
    }
}
