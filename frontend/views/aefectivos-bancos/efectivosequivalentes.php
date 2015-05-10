<?php

use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use kartik\widgets\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use kartik\popover\PopoverX;
//use kartik\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosBancos */

$this->title = Yii::t('app', 'Efectivos y sus equivalentes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Efectivos bancos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aefectivos-bancos-create">

    <center><h1><?= Html::encode($this->title) ?></h1>

   <?php
   				/*
                $menuItems[] =  ['label'=>'Efectivos en bancos', 'url'=>['/aefectivos-bancos/create']];
                $menuItems[] =   ['label'=>'Efectivos en caja', 'url'=>['/aefectivos-cajas/create']];
                         $menuItems[] =   ['label'=>'Inversiones para negociar', 'url'=>['/ainversiones-negociar/create']];
   				$menuItems[] = ['label'=>'Ver resumen', 'url'=>['/aefectivos-bancos/efectivosequivalentes']];	
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
        <div class="container">
          Probando
        </div>
        	AQUI IRIA LA HOJA RESUMEN ALGO ASI COMO EL EXCEL QUE ELLA MANDO


<?php
 $form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false]]);
 $attribs = $model->getFormAttribs('nacional');
//unset($attribs['attributes']['color']);
/*$attribs['status'] = [
    'type'=>TabularForm::INPUT_WIDGET,
    'widgetClass'=>\kartik\widgets\SwitchInput::classname()
];*/

/*
echo TabularForm::widget([
    'dataProvider'=>$dataProvider,
    'form'=>$form,
    'attributes'=>$attribs,
    'gridSettings'=>[
        'floatHeader'=>false,
        'panel'=>[
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Gestionar Bancos</h3>',
            'type' => GridView::TYPE_PRIMARY,
            'after'=> $this->render('_modal-form',['model'=>$model]). ' '.
                    Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
                    Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
        ]
    ]
]);*/


ActiveForm::end();
?>
    <?php
    $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        //'id',
        'saldo_segun_b',
        'nd_no_cont',
        'depo_transito',
        'nc_no_cont',
        'cheques_transito',
        'saldo_al_cierre',
        'intereses_act_eco',
        'tipo_moneda_id',
        'monto_moneda_extra',
        'tipo_cambio_cierre',
/*        [
            'attribute'=>'nd_no_cont',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
        ],
        [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'depo_transito',
            'vAlign'=>'middle',
        ],*/
        [
            'class'=>'kartik\grid\ActionColumn',
            'dropdown'=>false,
            'order'=>DynaGrid::ORDER_FIX_RIGHT
        ],
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];
    use app\models\AEfectivosBancosSearch;
    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            //'filterModel'=>AEfectivosBancosSearch,
            'panel'=>['heading'=>'<h3 class="panel-title">Efectivo en Bancos</h3>'],
        ],
        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]);

    ?>
</div>