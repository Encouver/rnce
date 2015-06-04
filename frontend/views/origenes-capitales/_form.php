<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;




/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="origenes-capitales-form">

    <?php

    //$model->scenario = 'extranjero';
    $form = ActiveForm::begin([
        'type'=>ActiveForm::TYPE_VERTICAL]);?>
    
     <?= $form->field($model, 'efectivo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'banco')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'bien')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'cuenta_pagar')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'decreto')->hiddenInput()->label(false) ?>
   <?php echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs($model->getScenario())
    ]);
   
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
