<p><h2>Оборудование 4 отделения</h2></p>

<?php
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use kartik\grid\DataColumn;
use app\models\teh\tool\Tool;
use app\models\teh\category\Category;
use app\models\teh\tool\ToolSearch;
use \app\models\teh\paks\Paks;
use \app\models\teh\place\Place;
use \app\models\teh\complex\Complex;


  echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
        'pjax'=>true,
        'striped'=>true,
//        'panel'=>['type'=>'primary', 'heading'=>'Основное оборудование'],
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'beforeGrid'=>'My fancy content before.',
            'afterGrid'=>'My fancy content after.',
        ],
        'resizableColumns'=>true,
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => 'Запись',
//        'itemLabelPlural' => 'books',
        'columns'=>[
            [
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
            ],
            [
                'attribute'=>'place_id',
                'width'=>'150px',
                'hAlign'=>'center',

                'value'=>function ($model, $key, $index, $widget) {
                  return $model->place ? $model->place->place_title : '-';
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>Place::PlaceList(),
//                'filter'=>['95', '96', '97'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Выберите'],
                'group'=>true,  // enable grouping

            ],
            [
                'attribute'=>'pak_id',
                'width'=>'300px',
                'value'=>function ($model, $key, $index, $widget) {
                  return $model->pak->pak_title;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>Paks::PakLIst(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Выберите'],
                'group'=>true,  // enable grouping,
                'subGroupOf'=>1 // supplier column index is the parent group
//                'groupedRow'=>true,                    // move grouped column to a single grouped row
//                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
//                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
            [
                'attribute'=>'category_id',
                'width'=>'350px',
                'value'=>function ($model, $key, $index, $widget) {
                  return $model->category->cat_title;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>Category::CategoryList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Выберите'],
                'group'=>true,  // enable grouping
                'subGroupOf'=>1 // supplier column index is the parent group

            ],
            [
                'attribute'=>'fullTitle',
                'width'=>'400px',
                'value'=>function ($model, $key, $index, $widget) {
                  return Html::a($model->tool_manufact . " " . $model->tool_model, '/');
                },
                'format' => 'raw',
            ],
            [
                'attribute'=>'parent_id',
                'hAlign'=>'left',
                'value'=>function ($model, $key, $index, $widget) {
                  if ($model->complex == null) {
                    return 'Отлельная единица';
                  } else {
                    return $model->complex->complex_title;
                  }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>Complex::ParentList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Выберите'],
                'group'=>true,  // enable grouping,

            ],
/*            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'comment',
                'value' => 'place.comment',
                'pageSummary' => true
            ],*/
            [
                'class' => '\kartik\grid\ActionColumn',
                'deleteOptions' => ['label' => '<i class="fa fa-trash"></i>']
            ],
        ],
 ]);


?>

