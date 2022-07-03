<?php
namespace common\components;

use Spatie\ImageOptimizer\OptimizerChainFactory;
use yii\base\Component;

class ImageOptimizer extends Component
{
    private $optimizeChain = false;

    public function __construct(array $config = [])
    {
      parent::__construct($config);
      $this->optimizeChain = OptimizerChainFactory::create();
    }

    public function optimize($imagePath)
    {
      $this->optimizeChain->optimize($imagePath);
    }

    public function deleteEXIFMetadata($imagePath)
    {
      $img = new \Imagick($imagePath);
      $orientation = $img->getImageOrientation();
      switch($orientation) {
          case \Imagick::ORIENTATION_BOTTOMRIGHT:
              $img->rotateimage("#000", 180); // rotate 180 degrees
          break;
          case \Imagick::ORIENTATION_RIGHTTOP:
              $img->rotateimage("#000", 90); // rotate 90 degrees CW
          break;
          case \Imagick::ORIENTATION_LEFTBOTTOM:
              $img->rotateimage("#000", -90); // rotate 90 degrees CCW
          break;
      }
      $img->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
      $img->writeImage($imagePath);
      $img->clear();
      $img->destroy();
    }
}
