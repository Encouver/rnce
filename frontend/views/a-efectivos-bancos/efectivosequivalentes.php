<?php

use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use kartik\widgets\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use kartik\popover\PopoverX;

use app\models\AEfectivosCajaSearch;
use app\models\AEfectivosBancosSearch;
use app\models\AInversionesNegociarSearch;

use common\models\c\SysTotales;

//use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosBancos */

$this->title = Yii::t('app', 'Efectivos y sus equivalentes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Efectivos bancos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aefectivos-bancos-create">

    <center><h1><?= Html::encode($this->title) ?></h1>
      <br/>
   
   <?php
   			/*
                $menuItems[] =  ['label'=>'Efectivos en bancos', 'url'=>['/a-efectivos-bancos/create']];
                $menuItems[] =   ['label'=>'Efectivos en caja', 'url'=>['/a-efectivos-cajas/create']];
                         $menuItems[] =   ['label'=>'Inversiones para negociar', 'url'=>['/a-inversiones-negociar/create']];
   				$menuItems[] = ['label'=>'Ver resumen', 'url'=>['/a-efectivos-bancos/efectivosequivalentes']];
   					$navBarOptions = array();
            NavBar::begin($navBarOptions);
					echo NavX::widget([
					    'options' => ['class' => 'navbar-nav'],
					    'items' => $menuItems,
					    'activateParents' => true,
					    'encodeLabels' => false
					]);
					NavBar::end();
          */
        ?>
    </center>

    <?php
    $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        //'id',
        'tipo_caja',
        'modena',
        [
          'attribute' => 'nombre_caja_id',
          'label' => 'Nombre caja',
          'format' => 'html',
          'value' => function ($efectivo_caja)
          {
              //return '<div>'.$efectivo_caja->bancoContratista->banco->nombre.'</div>';
          }
        ],
        [
            'attribute' => 'saldo_cierre_ae',
            'label' => 'Saldo al cierre',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true
        ],
        
        [
          'attribute' => 'tipo_moneda_id',
          'label' => 'Divisa',
          'format' => 'html',
          'value' => function ($efectivo_caja)
          {
              //return '<div>'.$efectivo_caja->bancoContratista->banco->nombre.'</div>';
          }
        ],
        'monto_me',
        'tipo_cambio_cierre',
        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'order'=>DynaGrid::ORDER_FIX_RIGHT
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];
    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider_ec,
            'showPageSummary'=>true,
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title">Efectivo en caja</h3>'],
            'toolbar' =>  [
              ['content'=>
                  Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['a-efectivos-cajas/create'], ['class' => 'btn btn-success']),
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
        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]);

    ?>

    <!--/EFECTIVOS CAJA-->


    <?php
    $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        //'id',
        [
          'attribute' => 'banco_contratista_id',
          'label' => 'Banco',
          'format' => 'html',
          'value' => function ($efectivo_bancos)
          {
              return '<div>'.$efectivo_bancos->bancoContratista->banco->nombre.'</div>';
          }
        ],
        'saldo_segun_b',
        'nd_no_cont',
        'depo_transito',
        'nc_no_cont',
        'cheques_transito',
        'saldo_al_cierre',
        'intereses_act_eco',
        [
          'attribute' => 'tipo_moneda_id',
          'label' => 'Tipo moneda',
          'format' => 'html',
          'value' => function ($efectivo_bancos)
          {
              return '<div>'.$efectivo_bancos->tipoMoneda->nombre.'</div>';
          }
        ],
        
        'monto_moneda_extra',
        'tipo_cambio_cierre',
        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'order'=>DynaGrid::ORDER_FIX_RIGHT
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];

    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider_eb,
            'showPageSummary'=>true,
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title">Efectivo en bancos</h3>'],

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

    <!--/EFECTIVOS BANCOS-->

    <?php
    $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        //'id',
        [
          'attribute' => 'banco_id',
          'label' => 'Banco',
          'format' => 'html',
          'value' => function ($inversiones)
          {
              return '<div>'.$inversiones->bancoContratista->banco->nombre.'</div>';
          }
        ],
        'fecha_inversion',
        'fecha_finalizacion',
        'tasa',
        'plazo',
        'costo_adquisicion',
        'valorizacion',
        'saldo_al_cierre',
        'intereses_act_eco',
        [
          'attribute' => 'tipo_moneda_id',
          'label' => 'Tipo moneda',
          'format' => 'html',
          'value' => function ($inversiones)
          {
              return '<div>'.$inversiones->tipoMoneda->nombre.'</div>';
          }
        ],
      
        'monto_moneda_extra',
        'tipo_cambio_cierre',
        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'order'=>DynaGrid::ORDER_FIX_RIGHT
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];
    //use app\models\AEfectivosBancosSearch;
    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider_in,
            'showPageSummary'=>true,
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title">Inversiones para negociar</h3>'],

            'toolbar' =>  [
              ['content'=>
                  Html::a(Yii::t('app', '<i class="glyphicon glyphicon-plus"></i>'), ['a-inversiones-negociar/create'], ['class' => 'btn btn-success']),
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
        'options'=>['id'=>'dynagrid-3'] // a unique identifier is important
    ]);

    ?>

    <!--/INVERSIONES PARA NEGOCIAR-->


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
</div>  