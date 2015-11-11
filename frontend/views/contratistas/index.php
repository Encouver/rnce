<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratistasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Datos básicos');
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
           // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'denominacion',
                'label'=>'Nombre contratista',
                'value'=>'naturalJuridica.denominacion'
                ],
             [
                'attribute'=>'rif',
                'label'=>'Rif',
                'value'=>'naturalJuridica.rif'
                ],
                
             [
                'attribute'=>'tipo_sector',
                'label'=>'Sector',
                'value'=>'tipo_sector'
                ],
            [
                'attribute'=>'sigla',
                'label'=>'Sigla',
                'value'=>'sigla'
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

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],
        ],
    ]); ?>
  <?php if(Yii::$app->user->identity->contratista_id == null){ ?>
        <?= Html::a(Yii::t('app', 'Registrar como persona natural'), ['creardatonatural'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Registrar como persona jurídica'), ['creardatojuridica'], ['class' => 'btn btn-success']) ?>
    <?php } ?>

</div>
