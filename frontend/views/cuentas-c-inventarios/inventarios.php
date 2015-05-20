<?php

use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use kartik\widgets\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosBancos */

$this->title = Yii::t('app', 'Inventarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Efectivos bancos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="aefectivos-bancos-form">

    <center><h1><?= Html::encode($this->title) ?></h1>
      <br/>
    </center>

    <?php
    $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        //'id',
        [
          'attribute' => 'tipo_inventario_id',
          'label' => 'Tipo inventario',
          'format' => 'html',
          'value' => function ($model)
          {
              return '<div>'.$model->cuentasCTiposInventarios->nombre.'</div>';
          }
        ],
        [
            'attribute' => 'detalle_inventario',
            'label' => 'Detalle',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            /*'format'=>['decimal', 2],
            'pageSummary'=>true*/
        ],
        [
            'attribute' => 'tecnica_medicion_id',
            'label' => 'Tecnica de medición',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'value' => function ($model)
            {
                //return '<div>'.$efectivo_bancos->bancoContratista->banco->nombre.'</div>';
            }
            /*'format'=>['decimal', 2],

            'pageSummary'=>true*/
        ],
        [
            'attribute' => 'formula_tecnica_id',
            'label' => 'Formula tecnica',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',

        ],
        [
            'attribute' => 'inventario_inicial',
            'label' => 'Inventario inicial',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',

        ],
        [
            'attribute' => 'compra_ejercicio',
            'label' => 'Compras',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',

        ],
        [
            'attribute' => 'ventas_ejercicio',
            'label' => 'Ventas',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',

        ],
        [
            'attribute' => 'inventario_final',
            'label' => 'Inventario final',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',

        ],
        [
          'attribute' => 'valor_neto_realizacion',
          'label' => 'Valor neto',
          'format' => 'html',
          'value' => function ($model)
          {
              //return '<div>'.$efectivo_bancos->tipoMoneda->nombre.'</div>';
          }
        ],
        
        'frecuencia_rotacion',
        'variacion_inflacion',
        'costo_ajustado',
        'deterioro',
        'reverso_deterioro',
        'valor_neto_ajus_cierre',
        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'order'=>DynaGrid::ORDER_FIX_RIGHT,
            'template' => '{update}{delete}'
            //'controller' => 'a-efectivos-cajas'
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];

    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            //'showPageSummary'=>true,
            'summary' => '',
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title"></h3>'],

            'toolbar' =>  [
              ['content'=>
                  Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['create'], ['class' => 'btn btn-success']),
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
        'options'=>['id'=>'dynagrid-2'] // a unique identifier is important
    ]);

    ?>
<!--
    <div> 
        <table class="table table-bordered">
            <caption>Total efectivo y sus equivalentes</caption>
            <thead>
              <tr>
                <th>
                    Saldo al cierre de la actividad económica
                </th>
                <th>
                    Intereses generados durante actividad económica
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                    Probando
                </td>
                 <td>
                    Probando
                </td>
              </tr>
            </tbody>
        </table>
    </div>
    <?php
        //$model = new SysTotales();
        //$total = $model->getTotales();
        //print_r($total); 
    ?>
    -->
</div>  