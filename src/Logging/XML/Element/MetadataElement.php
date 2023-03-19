<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class MetadataElement extends AbstractElement {

    public function __construct(XMLWriter $writer) {
        parent::__construct($writer);

        $this->startElement('configuration');
    }

}
