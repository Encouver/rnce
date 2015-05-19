<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivosAvaluosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activos Avaluos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-avaluos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Activos Avaluos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--
    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bien_id',
            'valor',
            'fecha_informe',
            'perito_id',
            // 'gremio_id',
            // 'num_inscripcion_gremio',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
    -->

    <?php

    $columns =
        [
            ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
            [
                'attribute'=>'bien_id',
                //'header'=>'Banco',
                'vAlign'=>'middle',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->etiqueta();
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Banco'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'valor',
                'hAlign'=>'right',
                'vAlign'=>'middle',
                'width'=>'100px',
                'format'=>['decimal', 2],
                'pageSummary'=>true
            ],
            [
                'attribute'=>'fecha_origen',
                'filterType'=>GridView::FILTER_DATE,
                'format'=>'raw',
                'width'=>'170px',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
            ],
            [
                'attribute'=>'perito_id',
                //'header'=>'Banco',
                'vAlign'=>'middle',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->etiqueta();
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Banco'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'gremio_id',
                //'header'=>'Banco',
                'vAlign'=>'middle',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->etiqueta();
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Banco'],
                'format'=>'raw'
            ],
            'num_inscripcion_gremio',


        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            //'urlCreator'=>function($action, $model, $key, $index) { return '#'; },
            'template'=>'{update} {delete}',
            'buttons'=>[
                /*'update' =>['url'=>Url::toRoute(['aa-obligaciones-bancarias/update','id'=>$model->id])], function ($url,$model) {
                    $url = Url::toRoute(['aa-obligaciones-bancarias/update','id'=>$model->id]);
                    return Html::a(

                        '<span class="glyphicon glyphicon-user"></span>',

                        $url);

                },*/
                /*             'delete' => function ($url,$model) {
                                 //$url = Url::toRoute(array_merge(['modify'], $urlConfig));
                                 return Html::a(

                                     '<span class="glyphicon glyphicon-user"></span>',

                                     $url);

                             },*/
            ],
            'viewOptions'=>['title'=>"Ver", 'data-toggle'=>'tooltip'],
            'updateOptions'=>['title'=>"Actualizar", 'data-toggle'=>'tooltip'],
            'deleteOptions'=>['title'=>"Eliminar", 'data-toggle'=>'tooltip'],
            'order'=>DynaGrid::ORDER_FIX_RIGHT
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];
    $dynagrid = DynaGrid::begin([
        'columns'=>$columns,
        'theme'=>'panel-info',
        'showPersonalize'=>true,
        'storage'=>'cookie',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            //'filterModel'=>$searchModel,
            'showPageSummary'=>true,
            'floatHeader'=>true,
            //'pjax'=>true,
            'summary'=>'',
            'panel'=>[
                'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-item"></i> Bienes </h3>',
                'before' =>  '<div style="padding-top: 7px;"><em> <!--Cuenta AA - Obligaciones Bancarias--> </em></divs>',
                'after' => false
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['create'], ['class' => 'btn btn-success'])  /*. ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])*/
                ],
                ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
                '{export}', ['class' => '\kartik\grid\ActionColumn', 'template' => '{view}',
                    'buttons' => [ 'imprimir' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,[
                            'title' => 'Imprimir',
                        ]);
                    },
                    ]
                ],
            ],


        ],
        'options'=>['id'=>'dynagrid-bienes'] // a unique identifier is important
    ]);

    if (substr($dynagrid->theme, 0, 6) == 'simple') {
        $dynagrid->gridOptions['panel'] = false;
    }

    DynaGrid::end();


    ?>
</div>
