<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\a\SysFormasOrg;
use common\models\a\SysTiposBienes;
use common\models\a\SysClasificacionesBien;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Bienes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-form">

    <?php $form = ActiveForm::begin(); 
/*            $clasificacionBien = ArrayHelper::map(SysClasificacionesBien::find()->all(), 'id', 'nombre');
            $tipoBien = array();
            if(!empty($model->sys_clasificacion_bien_id))
              $tipoBien = ArrayHelper::map(SysTiposBienes::find()->where(['sys_clasificacion_bien_id'=>$model->sys_clasificacion_bien_id])->all(), 'id', 'nombre', function($tipoBien){ return $tipoBien->sysClasificacionBien->nombre;});*/
          $tipoBien = ArrayHelper::map(SysTiposBienes::find()->all(), 'id', 'nombre', function($tipoBien){ return $tipoBien->sysClasificacionBien->nombre;});
        ?>
    <?= $form->field($model, 'sys_tipo_bien_id')->dropDownList(
            ArrayHelper::map(SysTiposBienes::find()->all(), 'id', 'nombre', function($tipoBien){ return $tipoBien->sysClasificacionBien->nombre;}),
            ['prompt'=>'Seleccione tipo de bien']
        );
    ?>

    <?php /*echo $form->field($model, 'sys_clasificacion_bien_id')->dropDownList(
            $clasificacionBien,
            ['prompt'=>'Seleccione la clasificación del bien',
              'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl(['/activos/listas-tipos-bien','id'=>'']).'"+$(this).val(), function( data ) {
                  $( "select#bienes-sys_tipo_bien_id" ).html( data );
                });
            '
            ]
        );*/
    ?>

    <?php /*echo $form->field($model, 'sys_tipo_bien_id')->dropDownList(
            $tipoBien,
            ['prompt'=>'Seleccione tipo de bien']
        );*/
    ?>

    <?= $form->field($model, 'detalle')->textarea(['maxlength' => 255]) ?>

    <?= $form->field($model, 'propio')->checkbox() ?>

    <?= $form->field($model, 'origen')->dropDownList(
           ['0'=>'APORTE DE ACCIONISTA','1'=>'ADQUISICION','2'=>'CONSTRUCCION','3'=>'FABRICACION','4'=>'DONACIÓN',],
            ['prompt'=>'Seleccione origen del bien',
                'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl(['/activos/origen','id'=>'']).'"+$(this).val(), function( data ) {
                  $( "#data-origen" ).html( data );
                });
            '
            ]
        );
    ?>

    <div id='data-origen'>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
