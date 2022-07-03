<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use common\models\User;
use common\models\Model;
use common\models\Photographer;
use common\models\ModelImage;

class BrowseController extends Controller
{

    public function actionIndex()
    {
      $query = Model::find()->leftJoin('user', 'user.id = model.userId')
        ->where(['user.status' => User::STATUS_ACTIVE]);

      if (isset($_GET['search']) AND !empty($_GET['search'])) {
          $str = explode(' ', $_GET['search']);
          if (sizeof($str) == 2) {
            $query->andWhere(['OR',
              ['LIKE', 'user.name', '%'.$str[0].'%', false],
              ['LIKE', 'user.surname', '%'.$str[0].'%', false],
              ['LIKE', 'user.name', '%'.$str[1].'%', false],
              ['LIKE', 'user.surname', '%'.$str[1].'%', false]
            ]);
          } else {
            $query->andWhere(['OR',
              ['LIKE', 'user.name', '%'.$str[0].'%', false],
              ['LIKE', 'user.surname', '%'.$str[0].'%', false]
            ]);
          }
      }

      if (isset($_GET['categoryId']) AND !empty($_GET['categoryId'])) {
        $query->andWhere(['model.categoryId' => $_GET['categoryId']]);
      }

      if (isset($_GET['gender']) AND !empty($_GET['gender'])) {
        $query->andWhere(['IN', 'model.gender', $_GET['gender']]);
      }

      if (isset($_GET['city']) AND !empty($_GET['city']) AND $_GET['city'] != 'any') {
        $query->andWhere(['model.city' => $_GET['city']]);
      }

      if (isset($_GET['hourPrice']['min']) AND !empty($_GET['hourPrice']['min']) AND isset($_GET['hourPrice']['max']) AND !empty($_GET['hourPrice']['max'])) {
        $query->andWhere(['>=', 'model.hourPrice', $_GET['hourPrice']['min']])
              ->andWhere(['<=', 'model.hourPrice', $_GET['hourPrice']['max']]);
      }

      if (isset($_GET['tfp']) AND !empty($_GET['tfp'])) {
        $query->andWhere(['IN', 'model.tfp', $_GET['tfp']]);
      }


      if (isset($_GET['height']['min']) AND !empty($_GET['height']['min']) AND isset($_GET['height']['max']) AND !empty($_GET['height']['max'])) {
        $query->andWhere(['>=', 'model.height', $_GET['height']['min']])
              ->andWhere(['<=', 'model.height', $_GET['height']['max']]);
      }
      if (isset($_GET['weight']['min']) AND !empty($_GET['weight']['min']) AND isset($_GET['weight']['max']) AND !empty($_GET['weight']['max'])) {
        $query->andWhere(['>=', 'model.weight', $_GET['weight']['min']])
              ->andWhere(['<=', 'model.weight', $_GET['weight']['max']]);
      }
      if (isset($_GET['shirt']['min']) AND !empty($_GET['shirt']['min']) AND isset($_GET['shirt']['max']) AND !empty($_GET['shirt']['max'])) {
        $query->andWhere(['>=', 'model.shirt', $_GET['shirt']['min']])
              ->andWhere(['<=', 'model.shirt', $_GET['shirt']['max']]);
      }
      if (isset($_GET['shoes']['min']) AND !empty($_GET['shoes']['min']) AND isset($_GET['shoes']['max']) AND !empty($_GET['shoes']['max'])) {
        $query->andWhere(['>=', 'model.shoes', $_GET['shoes']['min']])
              ->andWhere(['<=', 'model.shoes', $_GET['shoes']['max']]);
      }
      if (isset($_GET['bust']['min']) AND !empty($_GET['bust']['min']) AND isset($_GET['bust']['max']) AND !empty($_GET['bust']['max'])) {
        $query->andWhere(['>=', 'model.bust', $_GET['bust']['min']])
              ->andWhere(['<=', 'model.bust', $_GET['bust']['max']]);
      }
      if (isset($_GET['age']['min']) AND !empty($_GET['age']['min']) AND isset($_GET['age']['max']) AND !empty($_GET['age']['max'])) {
        $query->andWhere(['>=', 'model.age', $_GET['age']['min']])
              ->andWhere(['<=', 'model.age', $_GET['age']['max']]);
      }


      if (isset($_GET['ethnicity']) AND !empty($_GET['ethnicity'])) {
        $query->andWhere(['IN', 'model.ethnicity', $_GET['ethnicity']]);
      }
      if (isset($_GET['eye']) AND !empty($_GET['eye'])) {
        $query->andWhere(['IN', 'model.eyes', $_GET['eye']]);
      }
      if (isset($_GET['hair']) AND !empty($_GET['hair'])) {
        $query->andWhere(['IN', 'model.hair', $_GET['hair']]);
      }
      if (isset($_GET['tattoo']) AND !empty($_GET['tattoo'])) {
        $query->andWhere(['IN', 'model.tattoo', $_GET['tattoo']]);
      }



      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
              'pageSize' => 40,
          ],
      ]);

      return $this->render('index', [
        'dataProvider' => $dataProvider,
      ]);
    }



    public function actionPhotographers()
    {
      $query = Photographer::find()->leftJoin('user', 'user.id = photographer.userId')
        ->where(['user.status' => User::STATUS_ACTIVE]);

        if (isset($_GET['search']) AND !empty($_GET['search'])) {
            $str = explode(' ', $_GET['search']);
            if (sizeof($str) == 2) {
              $query->andWhere(['OR',
                ['LIKE', 'user.name', '%'.$str[0].'%', false],
                ['LIKE', 'user.surname', '%'.$str[0].'%', false],
                ['LIKE', 'user.name', '%'.$str[1].'%', false],
                ['LIKE', 'user.surname', '%'.$str[1].'%', false]
              ]);
            } else {
              $query->andWhere(['OR',
                ['LIKE', 'user.name', '%'.$str[0].'%', false],
                ['LIKE', 'user.surname', '%'.$str[0].'%', false]
              ]);
            }
        }

      if (isset($_GET['categoryId']) AND !empty($_GET['categoryId'])) {
        $query->andWhere(['photographer.categoryId' => $_GET['categoryId']]);
      }

      if (isset($_GET['gender']) AND !empty($_GET['gender'])) {
        $query->andWhere(['IN', 'photographer.gender', $_GET['gender']]);
      }

      if (isset($_GET['city']) AND !empty($_GET['city']) AND $_GET['city'] != 'any') {
        $query->andWhere(['photographer.city' => $_GET['city']]);
      }

      if (isset($_GET['tfp']) AND !empty($_GET['tfp'])) {
        $query->andWhere(['IN', 'photographer.tfp', $_GET['tfp']]);
      }

      if (isset($_GET['hourPrice']['min']) AND !empty($_GET['hourPrice']['min']) AND isset($_GET['hourPrice']['max']) AND !empty($_GET['hourPrice']['max'])) {
        $query->andWhere(['>=', 'photographer.hourPrice', $_GET['hourPrice']['min']])
              ->andWhere(['<=', 'photographer.hourPrice', $_GET['hourPrice']['max']]);
      }


      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
              'pageSize' => 40,
          ],
      ]);

      return $this->render('photographers', [
        'dataProvider' => $dataProvider,
      ]);
    }


    public function actionLocations()
    {
      return $this->render('locations');
    }


    public function actionOptimizeImages()
    {
      $dir = Yii::getAlias('@upload');
      $files = $this->get_dir_files($dir);


      foreach ($files as $key => $file) {
        Yii::$app->imageOptimizer->optimize($file);
      }

      // test($files);
      die;
    }



    private function get_dir_files( $dir, $recursive = true, $include_folders = false ){
    	if( ! is_dir($dir) )
    		return array();

    	$files = array();

    	$dir = rtrim( $dir, '/\\' ); // удалим слэш на конце

    	foreach( glob( "$dir/{,.}[!.,!..]*", GLOB_BRACE ) as $file ){

    		if( is_dir( $file ) ){
    			if( $include_folders )
    				$files[] = $file;
    			if( $recursive )
    				$files = array_merge( $files, $this->get_dir_files($file, $recursive, $include_folders ) );
    		}
    		else
    			$files[] = $file;
    	}

    	return $files;
    }

}
