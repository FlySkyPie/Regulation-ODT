<?php

namespace FlySkyPie\RegulationODText;

use FlySkyPie\RegulationODText\StyleLoaderInterface;

/**
 * Description of StyleLoader
 *
 * @author flyskypie
 */
class StyleLoader implements StyleLoaderInterface {
  private $document;

  public function addFontFaceTo(\DOMElement $parent) {
    $this->document = $parent->ownerDocument;
    $fontFaceAttributes = [
        [
            'style:name' => 'Times New Roman',
            'svg:font-family' => 'Times New Roman'
        ], [
            'style:name' => 'DFKai-sb',
            'svg:font-family' => 'DFKai-sb'
        ]
    ];

    foreach ($fontFaceAttributes as $fontFaceAttribute) {
      $fontFaceElement = $this->createElementWithAttribute('style:font-face', $fontFaceAttribute);
      $parent->appendChild($fontFaceElement);
    }
  }

  public function addStylesTo(\DOMElement $parent) {
    $this->document = $parent->ownerDocument;
    $this->addStyleDefaultStyleTo($parent);
    $this->addTitleStyleTo($parent);
    $this->addHistoriesStyleTo($parent);
    $this->addChapterStyleTo($parent);
  }

  private function addStyleDefaultStyleTo(\DOMElement $parent) {
    $defaultStyleAttribute = ['style:family' => 'paragraph'];
    $defaultStyleElement = $this->createElementWithAttribute('style:default-style', $defaultStyleAttribute);
    $styleParagraphPropertiesElement = $this->createDefaultParagraphPropertiesElement();
    $styleTextPropertiesElement = $this->createDefaultTextPropertiesElement();

    $defaultStyleElement->appendChild($styleParagraphPropertiesElement);
    $defaultStyleElement->appendChild($styleTextPropertiesElement);
    $parent->appendChild($defaultStyleElement);
  }

  private function addTitleStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規標題', 'style:family' => 'paragraph'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleParagraphPropertiesAttribute = [
        'fo:margin-top' => '0cm',
        'fo:margin-bottom' => '0cm',
        'fo:text-align' => 'center'
    ];
    $styleParagraphPropertiesElement = $this->createElementWithAttribute(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '24pt',
        'style:font-size-asian' => '24pt'
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addHistoriesStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規歷程', 'style:family' => 'paragraph'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleParagraphPropertiesAttribute = [
        'fo:margin-top' => '0cm',
        'fo:margin-bottom' => '0cm',
        'fo:text-align' => 'end'
    ];
    $styleParagraphPropertiesElement = $this->createElementWithAttribute(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '8pt',
        'style:font-size-asian' => '8pt'
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addChapterStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規章節', 'style:family' => 'text'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleTextPropertiesAttribute = [
        'fo:font-size' => '16pt',
        'fo:font-weight' => 'bold',
        'style:font-size-asian' => '16pt',
        'style:font-weight-asian' => 'bold'
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);


    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function createDefaultParagraphPropertiesElement(): \DOMElement {
    $attributes = [
        'fo:hyphenation-ladder-count' => 'no-limit',
        'style:text-autospace' => 'ideograph-alpha',
        'style:punctuation-wrap' => 'hanging',
        'style:line-break' => 'strict',
        'style:tab-stop-distance' => '1.249cm',
        'style:writing-mode' => 'page'
    ];
    return $this->createElementWithAttribute('style:paragraph-properties', $attributes);
  }

  private function createDefaultTextPropertiesElement(): \DOMElement {
    $attributes = [
        'style:use-window-font-color' => 'true',
        'style:font-name' => 'Times New Roman',
        'fo:font-size' => '12pt',
        'fo:language' => 'en',
        'fo:country' => 'US',
        'style:letter-kerning' => 'true',
        'style:font-name-asian' => 'DFKai-sb',
        'style:font-size-asian' => '12pt',
        'style:language-asian' => 'zh',
        'style:country-asian' => 'TW',
        'fo:hyphenate' => 'false',
        'fo:hyphenation-remain-char-count' => '2',
        'fo:hyphenation-push-char-count' => '2'
    ];

    return $this->createElementWithAttribute('style:text-properties', $attributes);
  }

  private function createElementWithAttribute(string $tagName, array $attributes): \DOMElement {
    $element = $this->document->createElement($tagName);
    foreach ($attributes as $key => $value) {
      $element->setAttribute($key, $value);
    }
    return $element;
  }

}
