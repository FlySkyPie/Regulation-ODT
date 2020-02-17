<?php

namespace FlySkyPie\RegulationODText;

/**
 * Description of XMLWriter
 *
 * @author flyskypie
 */
class XMLWriter {

  private $domDocument;

  public function __construct() {
    $this->domDocument = new \DomDocument('1.0', 'UTF-8');
  }
  
  public function getString():string{
    return $this->domDocument->saveXML();
  }

  protected function getDocument(): \DomDocument {
    return $this->domDocument;
  }

  /**
   * 
   * @param string $tagName
   * @param array $attributes
   * @param string $value
   * @return \DOMElement
   */
  protected function createNewElement(string $tagName, array $attributes=[],string $value=NULL): \DOMElement {
    $newNode = $this->domDocument->createElement($tagName,$value);
    foreach ($attributes as $key => $value) {
      $newNode->setAttribute($key, $value);
    }
    return $newNode;
  }

}
