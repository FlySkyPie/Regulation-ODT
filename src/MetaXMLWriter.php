<?php

namespace FlySkyPie\RegulationODText;

use FlySkyPie\RegulationODText\XMLWriter;

/**
 * Description of MetaXMLWriter
 *
 * @author flyskypie
 */
class MetaXMLWriter extends XMLWriter {

  public function __construct() {
    parent::__construct();
    $this->createRootElement();
  }

  private function createRootElement() {
    $attribute = [
        'office:version' => '1.2',
        'xmlns:office' => 'urn:oasis:names:tc:opendocument:xmlns:office:1.0',
        'xmlns:xlink' => 'http://www.w3.org/1999/xlink',
        'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
        'xmlns:meta' => 'urn:oasis:names:tc:opendocument:xmlns:meta:1.0',
        'xmlns:ooo' => 'http://openoffice.org/2004/office',
        'xmlns:grddl' => 'http://www.w3.org/2003/g/data-view#'
    ];

    $rootElement = $this->createNewElement('office:document-meta', $attribute);
    $rootElement->appendChild($this->getMeta());
    $this->getDocument()->appendChild($rootElement);
  }
  
  private function getMeta(){
    $element = $this->createNewElement('office:meta');
    $this->addMetas($element);
    return $element;
  }

  private function addMetas(\DOMElement $parent) {
    $date = date('Y-m-d\TH:i:s.v');
    $this->addMeta($parent, 'dc:title', '');
    $this->addMeta($parent, 'dc:subject', '');
    $this->addMeta($parent, 'dc:description', '');
    $this->addMeta($parent, 'dc:creator', '');
    $this->addMeta($parent, 'dc:date', $date);
    $this->addMeta($parent, 'meta:generator', 'RegulationODT');
    $this->addMeta($parent, 'meta:initial-creator', '');
    $this->addMeta($parent, 'meta:creation-date', $date);
    $this->addMeta($parent, 'meta:keyword', '');
  }

  private function addMeta(\DOMElement $parent, string $tagName, string $value) {
    $element = $this->createNewElement($tagName,[],$value);
    $parent->appendChild($element);
  }

}
