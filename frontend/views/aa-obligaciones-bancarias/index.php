<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AaObligacionesBancariasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aa Obligaciones Bancarias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aa-obligaciones-bancarias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!--  <p>
        <?/*= Html::a(Yii::t('app', 'Create Aa Obligaciones Bancarias'), ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
<!--
    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'corriente:boolean',
            'banco_id',
            'num_documento',
            'monto_otorgado',
            // 'fecha_prestamo',
            // 'fecha_vencimiento',
            // 'tasa_interes',
            // 'condicion_pago_id',
            // 'plazo',
            // 'tipo_garantia_id',
            // 'interes_ejer_econ',
            // 'interes_pagar',
            // 'importe_deuda',
            // 'total_imp_deu_int',
            // 'contratista_id',
            // 'anho',
            // 'creado_por',
            // 'actualizado_por',
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
            'attribute'=>'corriente',
            'vAlign'=>'middle',
        ],
        //'banco_id',
        [
            'attribute'=>'banco_id',
            //'header'=>'Banco',
            'vAlign'=>'middle',
            'value'=>function ($model, $key, $index, $widget) {
                return Html::a($model->banco->nombre, '#', [
                    'title'=>'Ver detalles del banco',
                    'onclick'=>'alert("This will open the banco page.\n\nDisabled for this demo!")'
                ]);
            },
            //'filterType'=>GridView::FILTER_SELECT2,
            //'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Banco'],
            'format'=>'raw'
        ],
        'num_documento',
        [
            'attribute'=>'monto_otorgado',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'fecha_prestamo',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
        ],
        [
            'attribute'=>'fecha_vencimiento',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
        ],
        [
            'attribute'=>'tasa_interes',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'condicion_pago_id',
            'vAlign'=>'middle',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->condicionPago->nombre;
            },
            'format'=>'raw'
        ],
         'plazo',
        [
            'attribute'=>'tipo_garantia_id',
            'vAlign'=>'middle',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->tipoGarantia->nombre;
            },
            'format'=>'raw'
        ],
        [
            'attribute'=>'interes_ejer_econ',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'interes_pagar',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'importe_deuda',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'attribute'=>'total_imp_deu_int',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],

/*        [
            'attribute'=>'corriente',
            'pageSummary'=>'Page Total',
            'vAlign'=>'middle',
            'order'=>DynaGrid::ORDER_FIX_LEFT
        ],
        [
            'attribute'=>'corriente',
            'class'=>'kartik\grid\BooleanColumn',
            'value'=>function ($model, $key, $index, $widget) {
                return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" .
                $model->color . '</code>';
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'publish_date',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
            'visible'=>false,
        ],
        [
            'attribute'=>'banco_id',
            'vAlign'=>'middle',
            'value'=>function ($model, $key, $index, $widget) {
                return Html::a($model->banco->nombre, '#', [
                    'title'=>'Ver detalles del banco',
                    'onclick'=>'alert("This will open the banco page.\n\nDisabled for this demo!")'
                ]);
            },
            //'filterType'=>GridView::FILTER_SELECT2,
            //'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Banco'],
            'format'=>'raw'
        ],*/

        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'urlCreator'=>function($action, $model, $key, $index) { return '#'; },
            //'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
            //'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
           // 'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'],
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
        'pjax'=>true,
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Obligaciones Bancarias - AA</h3>',
            'before' =>  '<div style="padding-top: 7px;"><em> Cuenta AA - Obligaciones Bancarias</em></divs>',
            'after' => false
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['create'], ['class' => 'btn btn-success'])  . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
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
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]);
if (substr($dynagrid->theme, 0, 6) == 'simple') {
    $dynagrid->gridOptions['panel'] = false;
}
DynaGrid::end();
?>
</div>
