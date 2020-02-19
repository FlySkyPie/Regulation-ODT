<?php

namespace FlySkyPie\RegulationODText\Loader;

use \FlySkyPie\RegulationODText\Loader\StyleLoaderInterface;

/**
 * Description of StyleLoader
 *
 * @author flyskypie
 */
class StyleLoader implements StyleLoaderInterface {

  /**
   * @var \DOMDocument
   */
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
    $this->addChapterParagraphStyleTo($parent);
    $this->addArticleParagraphStyleTo($parent);
    $this->addListParagraphStyleTo($parent);
    $this->addChapterStyleTo($parent);
    $this->addArticleStyleTo($parent);
    $this->addListStyleTo($parent);
    $this->addRegulationStyleTo($parent);
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
    $attributes = ['style:name' => '法規章節（文字樣式）', 'style:family' => 'text'];
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

  private function addArticleStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規條款（文字樣式）', 'style:family' => 'text'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleTextPropertiesAttribute = [
        'fo:font-size' => '14pt',
        'style:font-size-asian' => '14pt',
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);


    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addListStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規項次（文字樣式）', 'style:family' => 'text'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleTextPropertiesAttribute = [
        'fo:font-size' => '12pt',
        'style:font-size-asian' => '12pt',
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);


    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addChapterParagraphStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規章節（段落樣式）', 'style:family' => 'paragraph'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleParagraphPropertiesAttribute = [
        'fo:margin-top'=>'0.3in','fo:line-height' => '150%'];
    $styleParagraphPropertiesElement = $this->createElementWithAttribute(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '16pt',
        'fo:font-weight' => 'bold',
        'style:font-size-asian' => '16pt',
        'style:font-weight-asian' => 'bold'
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addArticleParagraphStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規條款（段落樣式）', 'style:family' => 'paragraph'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleParagraphPropertiesAttribute = ['fo:line-height' => '150%'];
    $styleParagraphPropertiesElement = $this->createElementWithAttribute(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '14pt',
        'style:font-size-asian' => '14pt',
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addListParagraphStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規項次（段落樣式）', 'style:family' => 'paragraph'];
    $styleNode = $this->createElementWithAttribute('style:style', $attributes);

    $styleParagraphPropertiesAttribute = ['fo:line-height' => '150%'];
    $styleParagraphPropertiesElement = $this->createElementWithAttribute(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '12pt',
        'style:font-size-asian' => '12pt',
    ];

    $styleTextPropertiesElement = $this->createElementWithAttribute(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    $parent->appendChild($styleNode);
  }

  private function addRegulationStyleTo(\DOMElement $parent) {
    $attributes = ['style:name' => '法規本文'];
    $styleNode = $this->createElementWithAttribute('text:list-style', $attributes);

    $numberAttributes = [
        ['text:style-name' => '法規章節（文字樣式）',
            'style:num-prefix' => '第',
            'style:num-suffix' => '章',
            'style:num-format' => '一, 二, 三, ...'],
        ['text:style-name' => '法規條款（文字樣式）',
            'style:num-prefix' => '第',
            'style:num-suffix' => '條',
            'style:num-format' => '一, 二, 三, ...'],
        ['text:style-name' => '法規項次（文字樣式）',
            'style:num-format' => ''],
        ['text:style-name' => '法規項次（文字樣式）',
            'style:num-suffix' => '、',
            'style:num-format' => '一, 二, 三, ...'],
        ['text:style-name' => '法規項次（文字樣式）',
            'style:num-prefix' => '（',
            'style:num-suffix' => '）',
            'style:num-format' => '一, 二, 三, ...'],
        ['text:style-name' => '法規項次（文字樣式）',
            'style:num-suffix' => '、',
            'style:num-format' => '1, 2, 3, ...']
    ];
    $alignmentAttributes = [
        [], ['text:list-tab-stop-position' => '1in',
            'fo:margin-left' => '1in',
            'fo:text-indent' => '-1in'],
        ['fo:margin-left' => '0.75in'],
        ['fo:text-indent' => '-0.5in',
            'fo:margin-left' => '1.5in'],
        ['fo:text-indent' => '-0.75in',
            'fo:margin-left' => '2in'],
        ['fo:text-indent' => '-0.5in',
            'fo:margin-left' => '2.25in']
    ];

    for ($i = 0; $i < 6; $i++) {
      $level = $i + 1;
      $levelElement = $this->createListLevelStyle($level, $numberAttributes[$i], $alignmentAttributes[$i]);

      $styleNode->appendChild($levelElement);
    }

    $parent->appendChild($styleNode);
  }

  private function createListLevelStyle(int $level, array $numberAttributes, array $alignmentAttributes) {
    $numberAttributes['text:level'] = \strval($level);
    $propertiesAttributes = ['text:list-level-position-and-space-mode' => 'label-alignment'];
    $alignmentAttributes['text:label-followed-by'] = 'listtab';

    $element3 = $this->createElementWithAttribute('style:list-level-label-alignment', $alignmentAttributes);
    $element2 = $this->createElementWithAttribute('style:list-level-properties', $propertiesAttributes);
    $element1 = $this->createElementWithAttribute('text:list-level-style-number', $numberAttributes);

    $element2->appendChild($element3);
    $element1->appendChild($element2);
    return $element1;
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
