<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\LimitacionesCapitales */

$this->title = Yii::t('app', 'Create Limitaciones Capitales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limitaciones-capitales-create">

   <?php 
   if(!$model->reintegro){
   echo Html::tag('h1', 'Crear Lmitaciones Capitales');
   
   }else{
       echo Html::tag('h1', 'Crear Reintegro de Perdidas');
   }
   ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
