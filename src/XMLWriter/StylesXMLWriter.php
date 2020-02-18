<?php

namespace FlySkyPie\RegulationODText\XMLWriter;

use FlySkyPie\RegulationODText\XMLWriter\XMLWriter;
use FlySkyPie\RegulationODText\StyleLoaderInterface;

/**
 * Description of StylesXMLWriter
 *
 * @author flyskypie
 */
class StylesXMLWriter extends XMLWriter {

  private $loader;

  public function __construct(StyleLoaderInterface $styleLoader) {
    parent::__construct();
    $this->loader = $styleLoader;

    $rootElement = $this->createRootElement();
    $this->addFontFaceDeculationTo($rootElement);
    $this->addStylesTo($rootElement);
    $this->addAutomaticStylesTo($rootElement);
    $this->addMasterStylesTo($rootElement);
  }

  /**
   * Declared specification version and XML namespaces.
   */
  private function createRootElement(): \DOMElement {
    $attribute = [
        'office:version' => '1.2',
        'xmlns:office' => 'urn:oasis:names:tc:opendocument:xmlns:office:1.0',
        'xmlns:style' => 'urn:oasis:names:tc:opendocument:xmlns:style:1.0',
        'xmlns:text' => 'urn:oasis:names:tc:opendocument:xmlns:text:1.0',
        'xmlns:table' => 'urn:oasis:names:tc:opendocument:xmlns:table:1.0',
        'xmlns:draw' => 'urn:oasis:names:tc:opendocument:xmlns:drawing:1.0',
        'xmlns:fo' => 'urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0',
        'xmlns:xlink' => 'http://www.w3.org/1999/xlink',
        'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
        'xmlns:meta' => 'urn:oasis:names:tc:opendocument:xmlns:meta:1.0',
        'xmlns:number' => 'urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0',
        'xmlns:svg' => 'urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0',
        'xmlns:chart' => 'urn:oasis:names:tc:opendocument:xmlns:chart:1.0',
        'xmlns:dr3d' => 'urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0',
        'xmlns:math' => 'http://www.w3.org/1998/Math/MathML',
        'xmlns:form' => 'urn:oasis:names:tc:opendocument:xmlns:form:1.0',
        'xmlns:script' => 'urn:oasis:names:tc:opendocument:xmlns:script:1.0',
        'xmlns:ooo' => 'http://openoffice.org/2004/office',
        'xmlns:ooow' => 'http://openoffice.org/2004/writer',
        'xmlns:oooc' => 'http://openoffice.org/2004/calc',
        'xmlns:dom' => 'http://www.w3.org/2001/xml-events',
        'xmlns:rpt' => 'http://openoffice.org/2005/report',
        'xmlns:of' => 'urn:oasis:names:tc:opendocument:xmlns:of:1.2',
        'xmlns:xhtml' => 'http://www.w3.org/1999/xhtml',
        'xmlns:grddl' => 'http://www.w3.org/2003/g/data-view#',
        'xmlns:tableooo' => 'http://openoffice.org/2009/table',
        'xmlns:css3t' => 'http://www.w3.org/TR/css3-text/'];

    $element = $this->createNewElement('office:document-styles', $attribute);
    $rootElement = $this->getDocument()->appendChild($element);

    return $rootElement;
  }

  /**
   * Declare typefaces. 
   */
  private function addFontFaceDeculationTo(\DOMElement $parent) {
    $fontFaceDeclsElement = $this->createNewElement('office:font-face-decls');

    $this->loader->addFontFaceTo($fontFaceDeclsElement);

    $parent->appendChild($fontFaceDeclsElement);
  }

  private function addStylesTo(\DOMElement $parent) {
    $stylesElement = $this->createNewElement('office:styles');

    $this->loader->addStylesTo($stylesElement);

    $parent->appendChild($stylesElement);
  }

  /**
   * automatic-styles>
   */
  private function addAutomaticStylesTo(\DOMElement $parent) {
    $automaticStylesElement = $this->createNewElement('office:automatic-styles');

    $stylePageLayoutElement = $this->createNewElement('style:page-layout', ['style:name' => 'Mpm1']);
    $stylePageLayoutPropertiesElement = $this->getStylePageLayoutPropertiesElement();
    $attributes = [
        'style:width' => '0.018cm',
        'style:line-style' => 'solid',
        'style:adjustment' => 'left',
        'style:rel-width' => '25%',
        'style:color' => '#000000'];

    $stylePootnoteSepElement = $this->createNewElement('style:footnote-sep', $attributes);
    $stylePageLayoutPropertiesElement->appendChild($stylePootnoteSepElement);
    $stylePageLayoutElement->appendChild($stylePageLayoutPropertiesElement);
    $automaticStylesElement->appendChild($stylePageLayoutElement);
    $parent->appendChild($automaticStylesElement);
  }

  private function addMasterStylesTo(\DOMElement $parent) {
    $masterStylesElement = $this->createNewElement('office:master-styles');

    $attributes = [
        'style:name' => 'Standard',
        'style:page-layout-name' => 'Mpm1'
    ];

    $masterPageStyleElement = $this->createNewElement('style:master-page', $attributes);
    $masterStylesElement->appendChild($masterPageStyleElement);
    $parent->appendChild($masterStylesElement);
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

}
