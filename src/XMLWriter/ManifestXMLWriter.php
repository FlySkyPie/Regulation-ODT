<?php

namespace FlySkyPie\RegulationODText\XMLWriter;

use FlySkyPie\RegulationODText\XMLWriter\XMLWriter;

/**
 * Description of ManifestXMLWriter
 *
 * @author flyskypie
 */
class ManifestXMLWriter extends XMLWriter {

  public function __construct() {
    parent::__construct();
    $this->createRootElement();
  }

  private function createRootElement() {
    $attribute = [
        'manifest:version' => '1.2',
        'xmlns:manifest' => 'urn:oasis:names:tc:opendocument:xmlns:manifest:1.0'
    ];

    $rootElement = $this->createNewElement('manifest:manifest', $attribute);
    $this->addEntries($rootElement);
    $this->getDocument()->appendChild($rootElement);
  }

  private function addEntries(\DOMElement $parent) {
    $attributes = [
        ['manifest:media-type' => 'application/vnd.oasis.opendocument.text',
            'manifest:full-path' => '/',
            'manifest:version' => '1.2'],
        ['manifest:media-type' => 'text/xml', 'manifest:full-path' => 'content.xml'],
        ['manifest:media-type' => 'text/xml', 'manifest:full-path' => 'meta.xml'],
        ['manifest:media-type' => 'text/xml', 'manifest:full-path' => 'styles.xml']
    ];
    foreach ($attributes as $attribute) {
      $this->addEntry($parent, $attribute);
    }
  }

  private function addEntry(\DOMElement $parent, array $attribute) {
    $element = $this->createNewElement('manifest:file-entry', $attribute);
    $parent->appendChild($element);
  }

}
