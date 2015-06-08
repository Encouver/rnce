<?php

use kartik\builder\TabularForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasI2DeclaracionIvaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas I2 Declaracion Ivas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-i2-declaracion-iva-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar declaración de IVA'), ['batch-update'], ['class' => 'btn btn-primary']) ?>
    </p>
<!--
    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'periodo_id',
            'certificado_electronico',
            'ventas_grabadas',
            'ventas_no_grabadas',
            // 'ingresos_totales',
            // 'debito_fiscal',
            // 'compras_gravadas',
            // 'compras_no_gravadas',
            // 'egresos_totales_compra',
            // 'credito_fiscal',
            // 'imp_pagar_compensar',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'anho',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>

   -->

    <?php
/*    // En la vista
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }*/

        $form = ActiveForm::begin();
            echo TabularForm::widget([
                // set entire form to static only (read only)
                //'staticOnly'=>true,
                'actionColumn'=>false,


                'dataProvider'=>$dataProvider,
                'form'=>$form,
                'attributes'=>$model->formAttribsStatic
            ]);

        ActiveForm::end();
    ?>
</div>
