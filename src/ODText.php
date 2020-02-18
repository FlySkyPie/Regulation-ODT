<?php

namespace FlySkyPie\RegulationODText;

use \FlySkyPie\RegulationODText\XMLWriter\StylesXMLWriter;
use \FlySkyPie\RegulationODText\XMLWriter\ManifestXMLWriter;
use \FlySkyPie\RegulationODText\XMLWriter\MetaXMLWriter;
use \FlySkyPie\RegulationODText\XMLWriter\ContentXMLWriter;
use \FlySkyPie\RegulationODText\Loader\StyleLoader;
use \FlySkyPie\RegulationODText\Loader\RegulationLoader;
use \PhpZip\ZipFile;

class ODText {

  /**
   * @var string
   */
  private $name;

  /**
   * @var bool
   */
  private $captered;

  /**
   * @var array
   */
  private $histories;

  /**
   * @var array
   */
  private $regulations;

  public function __construct() {
    $this->name = '';
    $this->captered = false;
    $this->histories = [];
    $this->regulations = [];
  }

  /**
   * Create a OpenDocumentText of regulation,
   * and return file path.
   * @return string
   */
  public function getFile(): string {
    $zipFile = new ZipFile();

    $styleLoader = new StyleLoader();
    $regulationLoader = new RegulationLoader();
    $regulationLoader->setName($this->name);
    $regulationLoader->setHistories($this->histories);
    $regulationLoader->setRagulations($this->regulations, $this->captered);

    $manifestXMLWriter = new ManifestXMLWriter();
    $metaXMLWriter = new MetaXMLWriter();
    $contentXMLWriter = new ContentXMLWriter($regulationLoader);
    $stylesXMLWriter = new StylesXMLWriter($styleLoader);

    $path = stream_get_meta_data(tmpfile())['uri'];
    $zipFile->addFromString('styles.xml', $stylesXMLWriter->getString())
            ->addFromString('content.xml', $contentXMLWriter->getString())
            ->addFromString('mimetype', 'application/vnd.oasis.opendocument.text')
            ->addFromString('META-INF/manifest.xml', $manifestXMLWriter->getString())
            ->addFromString('meta.xml', $metaXMLWriter->getString())
            ->saveAsFile($path)
            ->close();
    return $path;
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

  public function setCaptered(bool $chaptered) {
    $this->captered = $chaptered;
  }

}
