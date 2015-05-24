<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use kartik\widgets\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasJjProvicionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Jj Proviciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-jj-proviciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
 <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas jj proviciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
    //echo $efectivo_caja->getPromedio(1,3);

    $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        //'id',
        [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'corriente',
            'vAlign'=>'middle',
        ],
        [
          'attribute' => 'concepto_id',
          'label' => 'Concepto',
          'format' => 'html',
          'value' => function ($model)
          {
              return '<div>'.$model->concepto->nombre.'</div>';
          }
        ],
        [
          'attribute' => 'otro_nombre',
          'label' => 'Otros especifique',
          'format' => 'html',
          'value' => function ($model)
          {
              if($model->concepto->nombre=="Otros")
              {
                return '<div>'.$model->otro_nombre.'</div>';
              }
          }
        ],
        [
            'attribute' => 'saldo_p_anterior',
            'label' => 'Saldo del periodo anterior',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],

        [
            'attribute' => 'importe_provisionado_periodo',
            'label' => 'Importe provisionado del periodo',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        
        [
          'attribute' => 'aplicacion_amortizacion',
          'label' => 'Aplicación o amortización',
           'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
          'attribute' => 'saldo_al_cierre',
          'label' => 'Saldo al cierre',
           'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'order'=>DynaGrid::ORDER_FIX_RIGHT,
            'template' => '{update}{delete}',
            //'controller' => 'a-efectivos-cajas'
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];

    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider_c,
            'showPageSummary'=>true,
            'summary' => '',
            //'not-set' => 'N/A',
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title">Proviciones corriente</h3>'],
            'toolbar' =>  [
              [/*'content'=>
                  Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['create'], ['class' => 'btn btn-success']),*/
                  //Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
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
        'options'=>['id'=>'dynagrid-1', 'summaryText'=>''] // a unique identifier is important
    ]);


    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider_nc,
            'showPageSummary'=>true,
            'summary' => '',
            //'not-set' => 'N/A',
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title">Proviciones no corriente</h3>'],
            'toolbar' =>  [
              [/*'content'=>
                  Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['create'], ['class' => 'btn btn-success']),*/
                  //Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
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
        'options'=>['id'=>'dynagrid-1', 'summaryText'=>''] // a unique identifier is important
    ]);
    ?>
</div>