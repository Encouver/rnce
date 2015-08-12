<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelacionesContratosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Relaciones de Contratos');
$this->params['breadcrumbs'][] = $this->title;
$urlFactura = Url::to(['contratos-facturas/create']);
$urlValuacion = Url::to(['contratos-valuaciones/create']);
?>
<div class="relaciones-contratos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'contratista_id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Empresa',
                'value'=>'naturalJuridica.denominacion'
            ],
            'nombre_proyecto',
            'tipo_sector',
            'tipo_contrato',
            'fecha_inicio',
            'fecha_fin',
            'monto_contrato',
            'anticipo_recibido',
            'porcentaje_ejecucion',
            'evaluacion_ente:boolean',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'natural_juridica_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}'],
        ],
    ]); ?>
      <p>
        <?= Html::a(Yii::t('app', 'Agregar Relación de Contratos'), ['crearrelacioncontrato'], ['class' => 'btn btn-success']) ?>
    </p>
    <br />
   
    <h1>Ordenes de Facturas</h1>
    <?php Pjax::begin(['id'=>'factura-grid']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderFactura,
        'summary'=>'',
        //'filterModel' => $searchModelFactura,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'relacion_contrato_id',
            [
                'attribute'=>'relacion_contrato_id',
                'label'=>'Nombre Contrato',
                'value'=>'relacionContrato.nombre_proyecto'
            ],
            'orden_factura',
            'monto',
            //'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}','controller'=>'contratos-facturas'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    
 <?php  Modal::begin([
    'options'=>['id'=>'modal_contrato_factura','tabindex' => false],
    'header' => '<h4 style="margin:0; padding:0">Agregar Factura</h4>',
    'toggleButton' => ['label' => 'Agregar factura', 'class'=>'btn btn-success','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-factura">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form2 = ActiveForm::begin(['id'=>$modelcFactura->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlFactura, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelcFactura,
                'form'=>$form2,
                'columns'=>3,
                'attributes'=>$modelcFactura->getformAttribs()
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

<?php Modal::end();?> 
<br />
   
    <h1>Ordenes de Valuaciones</h1>
    <?php Pjax::begin(['id'=>'valuacion-grid']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderValuacion,
        'summary'=>'',
        //'filterModel' => $searchModelFactura,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'relacion_contrato_id',
            [
                'attribute'=>'relacion_contrato_id',
                'label'=>'Nombre Contrato',
                'value'=>'relacionContrato.nombre_proyecto'
            ],
            'orden_valuacion',
            'monto',
            //'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}','controller'=>'contratos-valuaciones'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    
 <?php  Modal::begin([
    'options'=>['id'=>'modal_contrato_valuacion','tabindex' => false],
    'header' => '<h4 style="margin:0; padding:0">Agregar Valuacion</h4>',
    'toggleButton' => ['label' => 'Agregar valuacion', 'class'=>'btn btn-success','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-valuacion">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form2 = ActiveForm::begin(['id'=>$modelcValuacion->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlValuacion, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelcValuacion,
                'form'=>$form2,
                'columns'=>3,
                'attributes'=>$modelcValuacion->getformAttribs()
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Enviar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

<?php Modal::end();?>  
</div>
