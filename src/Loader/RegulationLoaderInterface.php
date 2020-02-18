<?php

namespace FlySkyPie\RegulationODText\Loader;

/**
 *
 * @author flyskypie
 */
interface RegulationLoaderInterface {

  /**
   * This method should create a section containing regulation
   * and added it to parent element.
   * @param \DOMElement $parent
   */
  public function addRegulationTo(\DOMElement $parent);
}
