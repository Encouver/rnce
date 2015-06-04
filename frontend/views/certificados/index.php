<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CertificadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Certificados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'suscrito:boolean',
            'capital',
            'numero_asociacion',
            'valor_asociacion',
            'numero_aportacion',
            'valor_aportacion',
            'numero_rotativo',
            'valor_rotativo',
            'numero_inversion',
            'valor_inversion',
            // 'tipo_certificado',
            // 'suscrito:boolean',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'documento_registrado_id',
            // 'contratista_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
    <?php 
    if(!$model->existeregistro() && $model->validardenominacion()){ ?>
      <p>
        <?= Html::a(Yii::t('app', 'Crear Certificado'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php } ?>
   
</div>
