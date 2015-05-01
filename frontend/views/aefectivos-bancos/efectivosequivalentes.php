<?php

use yii\helpers\Html;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;


/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosBancos */

$this->title = Yii::t('app', 'Efectivos y sus equivalentes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Efectivos bancos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aefectivos-bancos-create">

    <center><h1><?= Html::encode($this->title) ?></h1>

   <?php 
   				
                $menuItems[] =  ['label'=>'Efectivos en bancos', 'url'=>['/aefectivos-bancos/create']];
                $menuItems[] =   ['label'=>'Efectivos en caja', 'url'=>['/aefectivos-cajas/create']];
                         $menuItems[] =   ['label'=>'Inversiones para negociar', 'url'=>['/ainversiones-negociar/create']];
   				$menuItems[] = ['label'=>'Ver resumen', 'url'=>['/aefectivos-bancos/efectivosequivalentes']];	
   					NavBar::begin($navBarOptions);
					echo NavX::widget([
					    'options' => ['class' => 'navbar-nav'],
					    'items' => $menuItems,
					    'activateParents' => true,
					    'encodeLabels' => false
					]);
					NavBar::end();
        ?>
        </center>
        <div class="container"></div>
        	AQUI IRIA LA HOJA RESUMEN ALGO ASI COMO EL EXCEL QUE ELLA MANDO
      
</div>