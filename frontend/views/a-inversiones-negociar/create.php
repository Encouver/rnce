<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\c\AInversionesNegociar */

$this->title = Yii::t('app', 'Create Ainversiones Negociar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ainversiones Negociars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$array[] = ['id' => 1, 'nombre' => 'Nacional'];
$array[] = ['id' => 2, 'nombre' => 'Extranjero'];
?>
<style type="text/css">
.tamano
{
	width: 400px;
	max-width: 400px;
}
</style>
<div class="ainversiones-negociar-create">

  <h1><?= Html::encode($this->title) ?></h1>

<?= Html::dropDownList("Tipo cuenta","", ArrayHelper::map($array, 'id', 'nombre'), ['id' => 'tipo_cuenta','class' => 'form-control tamano', 'prompt' => 'Seleccione tipo de banco',
                ]
            ) ?>
    <br>
    <div id="nacional" style="display:none">
    	<?php $model->scenario = 'nacional'; ?>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

	<div id="extranjero" style="display:none">
    	<?php $model->scenario = 'extranjero'; ?>
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
<?php
$script = <<< JS
    $('#tipo_cuenta').click(function(e){
            if($('#tipo_cuenta').val()==1){
               	$('#nacional').css('display','inherit');
               	$('#extranjero').css('display','none');
            }else if ($('#tipo_cuenta').val()==2) {
            	$('#extranjero').css('display','inherit');
            	$('#nacional').css('display','none');
            }else
            {
            	$('#nacional').css('display','none');
            	$('#extranjero').css('display','none');
            }
    });
JS;
$this->registerJs($script);
?>