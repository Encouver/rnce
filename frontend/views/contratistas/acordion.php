<?php

use yii\helpers\Html;
use yii\jui\Accordion;
use common\models\p\Direcciones;

/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */

$this->title = Yii::t('app', 'Crud Contratistas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$direccion = new Direcciones();

?>
<div class="contratistas-acordion">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Accordion::widget([
    'items' => [
        [
            'header' => 'Datos basicos',
            'content' => $this->render('datos_basicos'),
        ],
        [
            'header' => 'Direccion principal',
            'content' => $this->render('_direcciones_principales',['direccion' => $direccion]),
        ],
        [
            'header' => 'Section 3',
            'headerOptions' => ['tag' => 'h3'],
            'content' => 'Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus...',
            'options' => ['tag' => 'div'],
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['tag' => 'h3'],
    'clientOptions' => ['collapsible' => false],
]);?>
    
</div>
