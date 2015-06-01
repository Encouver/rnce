<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb2OtrasCuentasPorPagar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-bb2-otras-cuentas-por-pagar-form">
<?php
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs()
    ]);
?>
    <?php
        echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
        ActiveForm::end();
    ?>  
</div>
