<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosBancos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aefectivos-bancos-form">
<?php

    //$model->scenario = 'extranjero';
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> ($model->scenario== 'nacional') ? $model->getFormAttribs('nacional') : $model->getFormAttribs('extranjero')
    ]);
    echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>



</div>
