<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */

$this->title = Yii::t('app', 'Crear Contratista Persona Juridica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratistas-crearjuridica">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_persona_juridica', [
        'persona_juridica' => $persona_juridica,
    ]) ?>

</div>
