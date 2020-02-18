<?php

namespace FlySkyPie\RegulationODText;

use FlySkyPie\RegulationODText\RegulationLoaderInterface;

/**
 * Description of RegulationLoader
 *
 * @author flyskypie
 */
class RegulationLoader implements RegulationLoaderInterface {

  /**
   * @var \DOMDocument
   */
  private $document;

  /**
   *
   * @var string
   */
  private $name;

  /**
   *
   * @var array
   */
  private $histories = [];

  /**
   *
   * @var array
   */
  private $regulations = [];

  /**
   * This method should create a section containing regulation
   * and added it to parent element.
   * @param \DOMElement $parent
   */
  public function addRegulationTo(\DOMElement $parent) {
    $this->document = $parent->ownerDocument;
    $sectionElement = $this->createElement('text:section');

    $this->addTitleElementTo($sectionElement);
    $this->addHistoriesElementTo($sectionElement);
    $this->addArticlesElementTo($sectionElement);

    $parent->appendChild($sectionElement);
  }

  public function setName(string $name) {
    $this->name = $name;
  }

  public function setHistories(array $histories) {
    $this->histories = $histories;
  }

  public function setRagulations(array $regulations) {
    $this->regulations = $regulations;
  }

  private function addTitleElementTo(\DOMElement $parent) {
    $attributes = ['text:style-name' => '法規標題'];
    $element = $this->createElement('text:p', $attributes, $this->name);
    $parent->appendChild($element);
  }

  private function addHistoriesElementTo(\DOMElement $parent) {
    $attributes = ['text:style-name' => '法規歷程'];
    $element = $this->createElement('text:p', $attributes, $this->name);

    foreach ($this->histories as $history) {
      $node = $this->createTextNode($history);
      $element->appendChild($node);
      $element->appendChild($this->createElement('text:line-break'));
    }

    $parent->appendChild($element);
  }

  private function addArticlesElementTo(\DOMElement $parent) {
    $attributes = ['text:style-name' => '法規本文'];
    $element = $this->createElement('text:list', $attributes);

    foreach ($this->regulations as $subKey => $subArray) {
      $subItemElement = $this->getListElement($subKey, $subArray);
      $element->appendChild($subItemElement);
    }
    $parent->appendChild($element);
  }

  private function getListElement(string $key, array $array): \DOMElement {
    $itemElement = $this->createElement('text:list-item');
    $textElement = $this->createElement('text:p', [], $key);

    $itemElement->appendChild($textElement);

    if (empty($array)) {
      return $itemElement;
    }
    $listElement = $this->createElement('text:list');
    $itemElement->appendChild($listElement);
    foreach ($array as $subKey => $subArray) {
      $subItemElement = $this->getListElement($subKey, $subArray);
      $listElement->appendChild($subItemElement);
    }
    return $itemElement;
  }

  private function createElement(string $tagName, array $attributes = [], string $value = NULL): \DOMElement {
    $element = $this->document->createElement($tagName, $value);
    foreach ($attributes as $key => $value) {
      $element->setAttribute($key, $value);
    }
    return $element;
  }

  private function createTextNode(string $string): \DOMText {
    $node = $this->document->createTextNode($string);
    return $node;
  }

}
