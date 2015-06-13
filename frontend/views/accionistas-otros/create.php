<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\AccionistasOtros */

$this->title = Yii::t('app', 'Create Accionistas Otros');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accionistas Otros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accionistas-otros-create">

    <?php if($model->scenario=='representante'){
        echo Html::tag('h1', 'Agregar Representante Legal');
    }else{
        if($model->scenario=='junta'){
             echo Html::tag('h1', 'Agregar Junta Directiva');
        }else{
             echo Html::tag('h1', 'Crear Accionistas, Junta Directiva y Representante Legal');
        }
        
    } ?>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPersona'=>$modelPersona,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>
