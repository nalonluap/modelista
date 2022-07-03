<?php
namespace frontend\components;

use Yii;
use yii\base\Component;


class ImageOptimize extends Component
{
  private $apiKey = 'myFYJQMqKzyQhsjRXP0VSK3K2k6vhj49';


  public function optimize($img)
  {
    $ch = curl_init('https://api.tinify.com/shrink');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERPWD, ':' . $this->apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    	json_encode(
    		array(
    			'source' => array(
    				'url' => $img
    			)
    		)
    	)
    );

    $res = curl_exec($ch);
    curl_close($ch);

    $res = json_decode($res, JSON_OBJECT_AS_ARRAY);
    return $res;
  }


  public function getAllFiles()
  {
    $dir = Yii::getAlias('@upload');
    $files = $this->getDirFiles($dir);
    return $files;
  }

  public function getDirFiles($dir, $recursive = true, $includeFolders = false)
  {
    if(!is_dir($dir)) return array();
    $files = array();
    $dir = rtrim($dir, '/\\'); // удалим слэш на конце

    foreach(glob("$dir/{,.}[!.,!..]*", GLOB_BRACE ) as $file) {

      if(is_dir($file)) {
        if($includeFolders)
          $files[] = $file;
        if($recursive)
          $files = array_merge( $files, $this->getDirFiles($file, $recursive, $includeFolders) );
      }
      else
        $files[] = $file;
    }

    return $files;
  }
}
