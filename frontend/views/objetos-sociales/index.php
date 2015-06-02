<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetosSocialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objetos Sociales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-sociales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            
            //'contratista_id',
           [
               'attribute'=>'documento_registrado_id',
               'label'=>'Tipo documento',
               'value'=>'documentoRegistrado.tipoDocumento.nombre',
               ],
            //'documento_registrado_id',
            //'tipo_objeto',
            'descripcion:ntext',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
<?php 
    if(!$model->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agregar Objeto Social'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
</div>
