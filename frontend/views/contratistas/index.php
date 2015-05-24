<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratistasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contratistas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratistas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'contratista_id',
                'label'=>'Nombre contratista',
                'value'=>'contratista.naturalJuridica.denominacion'
                ],
             [
                'attribute'=>'contratista_id',
                'label'=>'Rif',
                'value'=>'contratista.naturalJuridica.rif'
                ],
                
             [
                'attribute'=>'contratista_id',
                'label'=>'Sector',
                'value'=>'contratista.tipo_sector'
                ],
            [
                'attribute'=>'contratista_id',
                'label'=>'Sigla',
                'value'=>'contratista.sigla'
            ],
            //'id',
            //'username',
            //'auth_key',
            //'password_hash',
            //'confirmation_token',
            // 'status',
            // 'superadmin',
            // 'created_at',
            // 'updated_at',
            // 'registration_ip',
            // 'bind_to_ip',
            // 'email:email',
            // 'email_confirmed:email',
            // 'contratista_id',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}{delete}'],
        ],
    ]); ?>
  
        <?= Html::a(Yii::t('app', 'Crear como persona natural'), ['creardatonatural'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Crear como persona jurdica'), ['creardatojuridica'], ['class' => 'btn btn-success']) ?>

</div>
