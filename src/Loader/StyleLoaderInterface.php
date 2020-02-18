<?php

namespace FlySkyPie\RegulationODText\Loader;

/**
 *
 * @author flyskypie
 */
interface StyleLoaderInterface {
  public function addFontFaceTo(\DOMElement $parent);
  public function addStylesTo(\DOMElement $parent);
}
