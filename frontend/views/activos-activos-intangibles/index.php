<?php

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivosActivosIntangiblesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activos Activos Intangibles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-activos-intangibles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?/*= Html::a(Yii::t('app', 'Create Activos Activos Intangibles'), ['create'], ['class' => 'btn btn-success']) */?>
    </p>

    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'bien.detalle',
            'certificado_registro',
            'fecha_registro',
            'vigencia',
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
            /*        [
                        'class'=>'kartik\grid\BooleanColumn',
                        'attribute'=>'corriente',
                        'vAlign'=>'middle',
                    ],*/

            [
                'attribute'=>'bien_id',
                'label'=>'Bien',
                //'header'=>'Banco',
                'vAlign'=>'middle',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->bien->etiqueta();
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Banco'],
                'format'=>'raw'
            ],
            'certificado_registro',
            [
                'attribute'=>'fecha_registro',
                'filterType'=>GridView::FILTER_DATE,
                'format'=>'raw',
                'width'=>'170px',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
            ],
            'vigencia',
            //'tipo_bien_id',
            [
                'attribute'=>'tipo_bien_id',
                'label'=>'Tipo de bien',
                //'header'=>'Banco',
                'vAlign'=>'middle',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->tipoBien->etiqueta();
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
                'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Activos - Intangibles</h3>',
                'before' =>  '<div style="padding-top: 7px;"><em> <!--Cuenta AA - Obligaciones Bancarias--> Corriente</em></divs>',
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
        'options'=>['id'=>'dynagrid-bienes-intangibles'] // a unique identifier is important
    ]);

    if (substr($dynagrid->theme, 0, 6) == 'simple') {
        $dynagrid->gridOptions['panel'] = false;
    }

    DynaGrid::end();

    ?>
</div>
