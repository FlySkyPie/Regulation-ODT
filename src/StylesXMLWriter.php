<?php

namespace FlySkyPie\RegulationODText;

/**
 * Description of StylesXMLWriter
 *
 * @author flyskypie
 */
class StylesXMLWriter {

  private $domDocument;
  private $rootElement;

  public function __construct() {
    $this->domDocument = new \DomDocument('1.0', 'UTF-8');

    $this->createRootElement();
    $this->createFontFaceDeculation();
    $this->createStyles();
    $this->createAutomaticStyles();
    $this->createMasterStyles();
  }

  public function getString(): string {
    //$this->domDocument->formatOutput = true;
    return $this->domDocument->saveXML();
  }

  /**
   * Declared specification version and XML namespaces.
   */
  private function createRootElement() {
    $newNode = $this->domDocument->createElement('office:document-styles');
    $rootElement = $this->domDocument->appendChild($newNode);
    $rootElement->setAttribute('office:version', '1.2');
    $rootElement->setAttribute('xmlns:office', 'urn:oasis:names:tc:opendocument:xmlns:office:1.0');
    $rootElement->setAttribute('xmlns:style', 'urn:oasis:names:tc:opendocument:xmlns:style:1.0');
    $rootElement->setAttribute('xmlns:text', 'urn:oasis:names:tc:opendocument:xmlns:text:1.0');
    $rootElement->setAttribute('xmlns:table', 'urn:oasis:names:tc:opendocument:xmlns:table:1.0');
    $rootElement->setAttribute('xmlns:draw', 'urn:oasis:names:tc:opendocument:xmlns:drawing:1.0');
    $rootElement->setAttribute('xmlns:fo', 'urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0');
    $rootElement->setAttribute('xmlns:xlink', 'http://www.w3.org/1999/xlink');
    $rootElement->setAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
    $rootElement->setAttribute('xmlns:meta', 'urn:oasis:names:tc:opendocument:xmlns:meta:1.0');
    $rootElement->setAttribute('xmlns:number', 'urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0');
    $rootElement->setAttribute('xmlns:svg', 'urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0');
    $rootElement->setAttribute('xmlns:chart', 'urn:oasis:names:tc:opendocument:xmlns:chart:1.0');
    $rootElement->setAttribute('xmlns:dr3d', 'urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0');
    $rootElement->setAttribute('xmlns:math', 'http://www.w3.org/1998/Math/MathML');
    $rootElement->setAttribute('xmlns:form', 'urn:oasis:names:tc:opendocument:xmlns:form:1.0');
    $rootElement->setAttribute('xmlns:script', 'urn:oasis:names:tc:opendocument:xmlns:script:1.0');
    $rootElement->setAttribute('xmlns:ooo', 'http://openoffice.org/2004/office');
    $rootElement->setAttribute('xmlns:ooow', 'http://openoffice.org/2004/writer');
    $rootElement->setAttribute('xmlns:oooc', 'http://openoffice.org/2004/calc');
    $rootElement->setAttribute('xmlns:dom', 'http://www.w3.org/2001/xml-events');
    $rootElement->setAttribute('xmlns:rpt', 'http://openoffice.org/2005/report');
    $rootElement->setAttribute('xmlns:of', 'urn:oasis:names:tc:opendocument:xmlns:of:1.2');
    $rootElement->setAttribute('xmlns:xhtml', 'http://www.w3.org/1999/xhtml');
    $rootElement->setAttribute('xmlns:grddl', 'http://www.w3.org/2003/g/data-view#');
    $rootElement->setAttribute('xmlns:tableooo', 'http://openoffice.org/2009/table');
    $rootElement->setAttribute('xmlns:css3t', 'http://www.w3.org/TR/css3-text/');
    $this->rootElement = $rootElement;
  }

  private function createStyles() {
    $newNode = $this->domDocument->createElement('office:styles');
    $stylesElement = $this->rootElement->appendChild($newNode);

    $stylesElement->appendChild($this->getStyleDefaultStyle());
    $stylesElement->appendChild($this->getTitleStyle());
    $stylesElement->appendChild($this->getHistoriesStyle());
  }

  private function getHistoriesStyle() {
    $styleNode = $this->createNewElement('style:style', ['style:name' => '法規歷程', 'style:family' => 'paragraph']);

    $styleParagraphPropertiesAttribute = [
        'fo:margin-top' => '0cm',
        'fo:margin-bottom' => '0cm',
        'fo:text-align' => 'end'
    ];
    $styleParagraphPropertiesElement = $this->createNewElement(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '8pt',
        'style:font-size-asian' => '8pt'
    ];

    $styleTextPropertiesElement = $this->createNewElement(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    return $styleNode;
  }

  private function getTitleStyle() {
    $styleNode = $this->createNewElement('style:style', ['style:name' => '法規標題', 'style:family' => 'paragraph']);

    $styleParagraphPropertiesAttribute = [
        'fo:margin-top' => '0cm',
        'fo:margin-bottom' => '0cm',
        'fo:text-align' => 'center'
    ];
    $styleParagraphPropertiesElement = $this->createNewElement(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
        'fo:font-size' => '24pt',
        'style:font-size-asian' => '24pt'
    ];

    $styleTextPropertiesElement = $this->createNewElement(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleNode->appendChild($styleParagraphPropertiesElement);
    $styleNode->appendChild($styleTextPropertiesElement);
    return $styleNode;
  }

  private function getStyleDefaultStyle(): \DOMElement {
    $styleDefaultStyleAttribute = ['style:family' => 'paragraph'];

    $styleDefaultStyleElement = $this->createNewElement('style:default-style', $styleDefaultStyleAttribute);


    $styleParagraphPropertiesAttribute = [
        'fo:hyphenation-ladder-count' => 'no-limit',
        'style:text-autospace' => 'ideograph-alpha',
        'style:punctuation-wrap' => 'hanging',
        'style:line-break' => 'strict',
        'style:tab-stop-distance' => '1.249cm',
        'style:writing-mode' => 'page'
    ];
    $styleParagraphPropertiesElement = $this->createNewElement(
            'style:paragraph-properties', $styleParagraphPropertiesAttribute);


    $styleTextPropertiesAttribute = [
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

    $styleTextPropertiesElement = $this->createNewElement(
            'style:text-properties', $styleTextPropertiesAttribute);

    $styleDefaultStyleElement->appendChild($styleParagraphPropertiesElement);
    $styleDefaultStyleElement->appendChild($styleTextPropertiesElement);
    return $styleDefaultStyleElement;
  }

  /**
   * Declare typefaces. 
   */
  private function createFontFaceDeculation() {
    $newNode = $this->domDocument->createElement('office:font-face-decls');
    $fontFaceDeclsElement = $this->rootElement->appendChild($newNode);

    $fontFace = $this->domDocument->createElement('style:font-face');
    $fontFace->setAttribute('style:name', 'Times New Roman');
    $fontFace->setAttribute('svg:font-family', 'Times New Roman');

    $fontFace2 = $this->domDocument->createElement('style:font-face');
    $fontFace2->setAttribute('style:name', 'DFKai-sb');
    $fontFace2->setAttribute('svg:font-family', 'DFKai-sb');

    $fontFaceDeclsElement->appendChild($fontFace);
    $fontFaceDeclsElement->appendChild($fontFace2);
  }

  /**
   * automatic-styles>
   */
  private function createAutomaticStyles() {
    $newNode = $this->domDocument->createElement('office:automatic-styles');
    $automaticStylesElement = $this->rootElement->appendChild($newNode);

    $stylePageLayoutElement = $this->createNewElement('style:page-layout', ['style:name' => 'Mpm1']);
    $stylePageLayoutPropertiesElement = $this->getStylePageLayoutPropertiesElement();
    $stylePootnoteSepElement = $this->domDocument->createElement('style:footnote-sep');

    $stylePootnoteSepElement->setAttribute('style:width', '0.018cm');
    $stylePootnoteSepElement->setAttribute('style:line-style', 'solid');
    $stylePootnoteSepElement->setAttribute('style:adjustment', 'left');
    $stylePootnoteSepElement->setAttribute('style:rel-width', '25%');
    $stylePootnoteSepElement->setAttribute('style:color', '#000000');

    $automaticStylesElement->appendChild($stylePageLayoutElement);
    $stylePageLayoutElement->appendChild($stylePageLayoutPropertiesElement);
    $stylePageLayoutPropertiesElement->appendChild($stylePootnoteSepElement);
  }

  private function getStylePageLayoutPropertiesElement() {
    $attributes = [
        'fo:page-width' => '21.001cm',
        'fo:page-height' => '29.7cm',
        'style:num-format' => '1',
        'style:print-orientation' => 'portrait',
        'fo:margin-top' => '2.501cm',
        'fo:margin-bottom' => '2cm',
        'fo:margin-left' => '2cm',
        'fo:margin-right' => '2cm',
        'style:writing-mode' => 'lr-tb',
        'style:layout-grid-color' => '#c0c0c0',
        'style:layout-grid-lines' => '25199',
        'style:layout-grid-base-height' => '0.423cm',
        'style:layout-grid-ruby-height' => '0cm',
        'style:layout-grid-mode' => 'none',
        'style:layout-grid-ruby-below' => 'false',
        'style:layout-grid-print' => 'false',
        'style:layout-grid-display' => 'false',
        'style:layout-grid-base-width' => '0.37cm',
        'style:layout-grid-snap-to' => 'true',
        'style:footnote-max-height' => '0cm'
    ];
    return $this->createNewElement('style:page-layout-properties', $attributes);
  }

  private function createMasterStyles() {
    $newNode = $this->domDocument->createElement('office:master-styles');
    $masterStylesElement = $this->rootElement->appendChild($newNode);

    $masterPageStyle = $this->domDocument->createElement('style:master-page');
    $masterPageStyle->setAttribute('style:name', 'Standard');
    $masterPageStyle->setAttribute('style:page-layout-name', 'Mpm1');

    $masterStylesElement->appendChild($masterPageStyle);
  }

  /**
   * 
   * @param string $tagName
   * @param array $attributes
   * @return \DOMElement
   */
  private function createNewElement(string $tagName, array $attributes): \DOMElement {
    $newNode = $this->domDocument->createElement($tagName);
    foreach ($attributes as $key => $value) {
      $newNode->setAttribute($key, $value);
    }
    return $newNode;
  }

}
