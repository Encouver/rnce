<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\BancosContratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-form">

  
    <?php

    //$model->scenario = 'extranjero';
    $form = ActiveForm::begin([
        'type'=>ActiveForm::TYPE_VERTICAL]);?>
   <?php echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs()
    ]);
    echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>
</div>
