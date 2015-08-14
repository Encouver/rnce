<?php

use common\models\p\PersonasNaturales;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-form">

    <?php $form = ActiveForm::begin([$model->isNewRecord?'action':'class'=>[$model instanceof PersonasNaturales?'contratistas/creardatonatural':'contratistas/creardatojuridica'],
        'type'=>ActiveForm::TYPE_VERTICAL]); ?>


    <?php
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>$model instanceof PersonasNaturales?3:2,
            'attributes'=>$model->getFormAttribs()
        ]);

       //echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
    ?>

<!--
    <?/*= $form->field($model2, 'rif')->textInput(['maxlength' => 50]) */?>
    
    <?/*= $form->field($model2, 'denominacion')->textInput(['maxlength' => 50]) */?>

    <?/*= $form->field($model, 'sigla')->textInput(['maxlength' => 50]) */?>
    
    <?/*= $form->field($model, 'tipo_sector')->dropDownList([ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', 'MIXTO' => 'MIXTO' ], ['prompt' => '']) */?>
  -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Guardar') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
