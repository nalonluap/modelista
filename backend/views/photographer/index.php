<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\User;


$this->title = 'Фотографы';
$this->params['menuItem'] = 'photographer';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="action-index photographer-index">

    <div class="clearfix">


    </div>


    <div class="card">

        <div class="card-body">
          <div class="table-responsive">
              <?= GridView::widget([
                  'layout' => '{summary}{pager}{items}{pager}',
                  'dataProvider' => $dataProvider,
                  'pager' => [
                      'class' => yii\widgets\LinkPager::className(),
                      'firstPageLabel' => Yii::t('app', 'First'),
                      'lastPageLabel' => Yii::t('app', 'Last')],
                  'filterModel' => $searchModel,
                  'columns' => [

                      'id',
                      'name',
                      'surname',
                      'email',
                      [
                          'attribute' => 'status',
                          'filter' => Html::activeDropDownList($searchModel, 'status', User::statusLabels(), ['class' => 'form-control', 'prompt' => '']),
                          'content' => function ($model, $key, $index, $column) use ($category){
                              //return isset($params[$model->param_id]) ? $params[$model->param_id] : null;
                              return User::statusLabels()[$model->status];
                          }
                      ],
                      [
                          'attribute' => 'updated_at',
                          'content' => function ($model, $key, $index, $column) use ($category){
                              //return isset($params[$model->param_id]) ? $params[$model->param_id] : null;
                              return date("Y-m-d H:i:s", $model->updated_at);
                          }
                      ],
                      [
                          'attribute' => 'created_at',
                          'content' => function ($model, $key, $index, $column) use ($category){
                              //return isset($params[$model->param_id]) ? $params[$model->param_id] : null;
                              return date("Y-m-d H:i:s", $model->created_at);
                          }
                      ],
                      [
                          'class' => 'yii\grid\ActionColumn',
                          'urlCreator' => function ($action, $model, $key, $index) {
                              // using the column name as key, not mapping to 'id' like the standard generator
                              $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                              $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                              return Url::toRoute($params);
                          },
                          'buttons' => [
                              'update' => function ($url, $model) {
                                  return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                                      'class' => 'btn btn-success',
                                      'title' => 'Редактировать',
                                      'aria-label' => 'Редактировать',
                                      'data-pjax' => 0,
                                  ]);
                              },
                              'delete' => function ($url, $model) {
                                  return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                                      'class' => 'btn btn-danger',
                                      'title' => 'Удалить',
                                      'aria-label' => 'Удалить',
                                      'data-method' => 'post',
                                      'data-pjax' => 0,
                                      'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?'
                                  ]);
                              },
                          ],
                          'template' => '<div class="btn-group">{update} {delete}</div>',
                          'contentOptions' => ['nowrap' => 'nowrap']
                      ],],
              ]); ?>
          </div>
        </div>

    </div>


</div>
