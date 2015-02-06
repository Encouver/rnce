<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inpc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpc-form">

    <?php $form = ActiveForm::begin(); 

    	$itemsM = array('1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Nomviembre', '12' => 'Diciembre');

    	$itemsA = array('2010' => 2010, '2011' => 2011, '2012' => 2012, '2013' => 2013, '2014' => 2014, '2015' => 2015);
    ?>

    <?= $form->field($model, 'ano')->dropDownList(
            $itemsA,
            ['prompt'=>'Seleccione el Año']
        );
    ?>

     <?= $form->field($model, 'mes')->dropDownList(
            $itemsM,       
            ['prompt'=>'Seleccione el Mes'] 
        );
    ?>

    <?= $form->field($model, 'indice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
