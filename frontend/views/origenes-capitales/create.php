<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */

$this->title = Yii::t('app', 'Create Origenes Capitales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Origenes Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$array[] = ['id' => 1, 'nombre' => 'EFECTIVO'];
$array[] = ['id' => 2, 'nombre' => 'EFECTIVO EN BANCO'];
$array[] = ['id' => 3, 'nombre' => 'PROPIEDADES PLANTAS Y EQUIPOS'];
?>
<style type="text/css">
.tamano
{
	width: 400px;
	max-width: 400px;
}
</style>
<div class="origenes-capitales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::dropDownList("Origen Capital","", ArrayHelper::map($array, 'id', 'nombre'), ['id' => 'tipo_origen','class' => 'form-control tamano', 'prompt' => 'Seleccione tipo de banco',
                ]
            ) ?>
    <br>
    <div id="efectivo" style="display:none">
    	<?php $origen_capital->scenario = 'efectivo';
                $origen_capital->tipo_origen='EFECTIVO';
        ?>

	    <?= $this->render('_form', [
	        'origen_capital' => $origen_capital,
	    ]) ?>
	</div>

	<div id="efectivoenbanco" style="display:none">
    	<?php $origen_capital->scenario = 'efectivoenbanco';
              $origen_capital->tipo_origen='EFECTIVO EN BANCO';
        ?>
	    <?= $this->render('_form', [
	        'origen_capital' => $origen_capital,
	    ]) ?>
	</div>

</div>
<?php
$script = <<< JS
    $('#tipo_origen').click(function(e){
            if($('#tipo_origen').val()==1){
               	$('#efectivo').css('display','inherit');
               	$('#efectivoenbanco').css('display','none');
            }else if ($('#tipo_origen').val()==2) {
            	$('#efectivoenbanco').css('display','inherit');
            	$('#efectivo').css('display','none');
            }else
            {
            	$('#efectivo').css('display','none');
            	$('#efectivoenbanco').css('display','none');
            }
    });
JS;
$this->registerJs($script);
?>
