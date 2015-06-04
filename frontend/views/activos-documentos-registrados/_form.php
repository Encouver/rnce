<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDocumentosRegistrados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-documentos-registrados-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName(),'action'=>$url, 'type'=>ActiveForm::TYPE_VERTICAL, 'options' => ['data-pjax' => Yii::$app->request->isPjax]]);  ?>

<!--
    <?php /*//Get all flash messages and loop through them
        foreach (Yii::$app->session->getAllFlashes() as $message):; */?>
        <?php
/*        echo \kartik\widgets\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ]
            ]
        ]);
        */?>
   <?php /*endforeach; */?> -->
    <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
    ?>

    <?php
    //echo '<h2> Carga de Documento Registrado: </h2>';
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'columnSize'=>'xs',
        'attributes'=>$model->getFormAttribs()
    ]);
    ?>

<!--
    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'sys_tipo_registro_id')->textInput() */?>

    <?/*= $form->field($model, 'num_registro_notaria')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'tomo')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'folio')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'fecha_registro')->textInput() */?>

    <?/*= $form->field($model, 'fecha_asamblea')->textInput() */?>

    <?/*= $form->field($model, 'sys_circunscripcion_id')->textInput() */?>

    <?/*= $form->field($model, 'valor_adquisicion')->textInput() */?>

    <?/*= $form->field($model, 'tipo_documento_id')->textInput() */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

   --> <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
