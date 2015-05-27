<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\builder\Form;
use kartik\popover\PopoverX;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivosDocumentosRegistradosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$urlDocumento = Url::to(['create']);
$this->title = Yii::t('app', 'Activos Documentos Registrados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-documentos-registrados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'tipo_documento_id',
                'label'=>'Tipo de documento',
                'value'=>'tipoDocumento.nombre'
            ],
            //'id',
            //'contratista_id',
            //'sys_tipo_registro_id',
            'num_registro_notaria',
            'tomo',
            'folio',
            'fecha_registro',
            'fecha_asamblea',
             [
                'attribute'=>'sys_circunscripcion_id',
                'value'=>'sysCircunscripcion.nombre'
            ],
            //'sys_circunscripcion_id',
            // 'valor_adquisicion',
            // 'tipo_documento_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
<?php 
    if(!$model->existe()){ ?>

    <?php  Modal::begin([
    'options'=>['id'=>'m1_documento'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Documento Registrado</h4>',
    'toggleButton' => ['label' => 'Agregar Documento Registrado', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
]);?>
<div id="output-documento">
    <?php $form2 = ActiveForm::begin(['id'=>$model->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlDocumento]); ?>
    <?php echo Form::widget([
        'model'=>$model,
        'form'=>$form2,
        'columns'=>3,
        'attributes'=>$model->formAttribs
    ]); ?>

<!--    <div class="form-group">
        <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
    </div>-->
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar') , ['class' =>'btn btn-success' ]) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php Modal::end();?>
<?php } ?>
</div>
<?php $script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e){
        var \$form = $(this);
        $.post(
            \$form.attr("action"), // serialize Yii2 form
            \$form.serialize()
        )
        .done(function(result){
            if(result == 1)
            {
                $(\$form).trigger("reset");

            }else{
            alert('Error');

            }
            $("#message").html(result.message);
        }).fail(function(){
            console.log("server errror");
        });
    });
JS;
    $this->registerJs($script);

/*        echo '<label class="cbx-label" for="s_2">Left</label>';
        echo CheckboxX::widget([
            'name'=>'s_2',
            'value'=>1,
            'options'=>['id'=>'s_2']
        ]);*/
    ?>
