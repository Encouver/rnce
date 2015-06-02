<?php

use kartik\builder\Form;
use kartik\widgets\Select2;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\p\SysBancos;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\c\AaObligacionesBancarias */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="aa-obligaciones-bancarias-form">

    <?php $form = ActiveForm::begin(); ?>
<?php


    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'columnSize'=>'xs',
        'attributes'=>$model->getFormAttribs()
    ]);
?>

<!--    <?/*= $form->field($model, 'corriente')->checkbox() */?>

    <?/*= //$form->field($model, 'banco_id')->textInput()
           // Usage with ActiveForm and model
        $form->field($model, 'banco_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(SysBancos::find()->asArray()->all(),'id','nombre'),
            'options' => ['placeholder' => 'Selecciones un banco ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    */?>

    <?/*= $form->field($model, 'num_documento')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'monto_otorgado')->widget(\kartik\money\MaskMoney::className(),[
//        'name' => 'amount_1',
//        'pluginOptions' => [
//            'prefix' => 'Bs ',
//            'suffix' => '',
//            'allowNegative' => false
//        ],
//        'value' => 28239.35,
//        'disabled' => true
    ]) */?>

    <?/*= //$form->field($model, 'fecha_prestamo')->textInput()
        $form->field($model, 'fecha_prestamo')->widget(\kartik\date\DatePicker::className(),[
            'model' => $model,
            'attribute' => 'fecha',
            //'name' => 'datetime_10',
            'options' => ['placeholder' => 'Seleccione fecha ...'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'd-M-yyyy ',
                'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                'todayHighlight' => true
            ]
        ])
    */?>

    <?/*= $form->field($model, 'fecha_vencimiento')->widget(\kartik\widgets\DatePicker::className(),[
        'model' => $model,
        'attribute' => 'fecha',
        //'name' => 'datetime_10',
        'options' => ['placeholder' => 'Seleccione fecha ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'd-M-yyyy ',
            'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
            'todayHighlight' => true
        ]
    ]) */?>

    <?/*= $form->field($model, 'tasa_interes')->textInput() */?>

    <?/*= //$form->field($model, 'condicion_pago_id')->textInput()
            $form->field($model, 'condicion_pago_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(\common\models\c\AaCondicionesPagos::find()->asArray()->all(),'id','nombre'),
                'options' => ['placeholder' => 'Seleccione banco ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->hint('Seleccione el banco');
    */?>

    <?/*= $form->field($model, 'plazo')->textInput() */?>

    <?/*= //$form->field($model, 'tipo_garantia_id')->textInput()
            $form->field($model, 'tipo_garantia_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\c\AaTiposGarantias::find()->asArray()->all(),'id','nombre'),
                'options' => ['placeholder' => 'Tipo de garantía ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);*/?>

    <?/*= $form->field($model, 'interes_ejer_econ')->textInput() */?>

    <?/*= $form->field($model, 'interes_pagar')->textInput() */?>

    <?/*= $form->field($model, 'importe_deuda')->textInput() */?>

    <?/*= $form->field($model, 'total_imp_deu_int')->textInput() */?>
 -->
<!--
    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => 100]) */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

  -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
