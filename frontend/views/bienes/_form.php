<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\activos\SysFormasOrg;
use common\models\activos\SysTiposBienes;

/* @var $this yii\web\View */
/* @var $model common\models\activos\Bienes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bienes-form">

     <?php $form = ActiveForm::begin(); 
            $principioContable = ArrayHelper::map(SysFormasOrg::find()->all(), 'id', 'nombre');
            $tipoBien = ArrayHelper::map(SysTiposBienes::find()->all(), 'id', 'nombre');
        ?>



    <?= $form->field($model, 'sys_tipo_bien_id')->dropDownList(
            $tipoBien,
            ['prompt'=>'Seleccione tipo de bien']
        );
    ?>

    <?= $form->field($model, 'principio_contable')->dropDownList(
            $principioContable,
            ['prompt'=>'Seleccione el principio contable']
        );
    ?>

    <?= $form->field($model, 'depreciable')->checkbox() ?>

    <?= $form->field($model, 'deterioro')->checkbox() ?>

    <?= $form->field($model, 'detalle')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'origen')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fecha_origen')->textInput() ?>

    <?= $form->field($model, 'propio')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
