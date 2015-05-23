<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */

$this->title = Yii::t('app', 'Crear Contratista Persona Natural');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratistas-crearnatural">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_persona_natural', [
        'persona_natural' => $persona_natural,
    ]) ?>

</div>
