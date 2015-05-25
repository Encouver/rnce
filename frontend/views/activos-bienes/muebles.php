<?php

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivosBienesSearch */
/* @var $searchModelMuebles app\models\ActivosMueblesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activos Bienes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-bienes-index">

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a(Yii::t('app', 'Create Activos Bienes'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<!--
    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sys_tipo_bien_id',
            'detalle',
            'origen_id',
            'fecha_origen',
            'contratista_id',
            'propio:boolean',
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
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'propio',
            'vAlign'=>'middle',
        ],
        [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'nacional',
            'vAlign'=>'middle',
        ],
        'detalle',
        [
            'attribute'=>'origen_id',
            //'header'=>'Banco',
            'vAlign'=>'middle',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->origen->nombre;
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
            'attribute'=>'fecha_origen',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
        ],

//
//                [
//                    'attribute'=>'monto_otorgado',
//                    'hAlign'=>'right',
//                    'vAlign'=>'middle',
//                    'width'=>'100px',
//                    'format'=>['decimal', 2],
//                    'pageSummary'=>true
//                ],
//
//                [
//                    'attribute'=>'fecha_vencimiento',
//                    'filterType'=>GridView::FILTER_DATE,
//                    'format'=>'raw',
//                    'width'=>'170px',
//                    'filterWidgetOptions'=>[
//                        'pluginOptions'=>['format'=>'yyyy-mm-dd']
//                    ],
//                ],
//                [
//                    'attribute'=>'tasa_interes',
//                    'hAlign'=>'right',
//                    'vAlign'=>'middle',
//                    'width'=>'100px',
//                    'format'=>['decimal', 2],
//                    'pageSummary'=>true
//                ],
//                [
//                    'attribute'=>'condicion_pago_id',
//                    'vAlign'=>'middle',
//                    'value'=>function ($model, $key, $index, $widget) {
//                        return $model->condicionPago->nombre;
//                    },
//                    'format'=>'raw'
//                ],
//                'plazo',
//                [
//                    'attribute'=>'tipo_garantia_id',
//                    'vAlign'=>'middle',
//                    'value'=>function ($model, $key, $index, $widget) {
//                        return $model->tipoGarantia->nombre;
//                    },
//                    'format'=>'raw'
//                ],
//                [
//                    'attribute'=>'interes_ejer_econ',
//                    'hAlign'=>'right',
//                    'vAlign'=>'middle',
//                    'width'=>'100px',
//                    'format'=>['decimal', 2],
//                    'pageSummary'=>true
//                ],
//                [
//                    'attribute'=>'interes_pagar',
//                    'hAlign'=>'right',
//                    'vAlign'=>'middle',
//                    'width'=>'100px',
//                    'format'=>['decimal', 2],
//                    'pageSummary'=>true
//                ],
//                [
//                    'attribute'=>'importe_deuda',
//                    'hAlign'=>'right',
//                    'vAlign'=>'middle',
//                    'width'=>'100px',
//                    'format'=>['decimal', 2],
//                    'pageSummary'=>true
//                ],
//                [
//                    'attribute'=>'total_imp_deu_int',
//                    'value'=>function ($model, $key, $index, $widget) {
//                        return $model->totalImpDeuInt->valor;
//                    },
//                    'hAlign'=>'right',
//                    'vAlign'=>'middle',
//                    'width'=>'100px',
//                    'format'=>['decimal', 2],
//                    'pageSummary'=>true
//                ],
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
    'options'=>['id'=>'dynagrid-bienes-muebles'] // a unique identifier is important
]);

if (substr($dynagrid->theme, 0, 6) == 'simple') {
    $dynagrid->gridOptions['panel'] = false;
}

DynaGrid::end();


?>
</div>
