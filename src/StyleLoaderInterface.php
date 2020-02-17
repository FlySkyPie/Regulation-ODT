<?php

namespace FlySkyPie\RegulationODText;

/**
 *
 * @author flyskypie
 */
interface StyleLoaderInterface {
  public function addFontFaceTo(\DOMElement $parent);
  public function addStylesTo(\DOMElement $parent);
}
