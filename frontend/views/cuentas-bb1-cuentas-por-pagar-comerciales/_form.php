<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb1CuentasPorPagarComerciales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-bb1-cuentas-por-pagar-comerciales-form">

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
