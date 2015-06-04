<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\widgets\Select2;
$urlPersona = Url::to(['personas-naturales/create']);
$urlJuridica = Url::to(['personas-juridicas/create']);
$urlDocumento = Url::to(['activos-documentos-registrados/createempresarelacionada']);

/* @var $this yii\web\View */
/* @var $model common\models\p\EmpresasRelacionadas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresas-relacionadas-form">
     <?php  Modal::begin([
    'options'=>['id'=>'persona_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar Persona Natural', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-natural">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form2 = ActiveForm::begin(['id'=>$modelPersona->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlPersona, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelPersona,
                'form'=>$form2,
                'columns'=>3,
                'attributes'=>$modelPersona->getformAttribs("basico")
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

<?php Modal::end();?>    
 <?php  Modal::begin([
    'options'=>['id'=>'persona_juridica'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Juridica</h4>',
    'toggleButton' => ['label' => 'Agregar Persona Juridica', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-juridica">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form3 = ActiveForm::begin(['id'=>$modelJuridica->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlJuridica, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelJuridica,
                'form'=>$form3,
                'columns'=>3,
                'attributes'=>$modelJuridica->getformAttribs()
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

<?php Modal::end();?>  
<?php  Modal::begin([
    'options'=>[
        'id'=>'m1_documento',
        'tabindex' => false // important for Select2 to work properly
    ],
    'header' => '<h4 style="margin:0; padding:0">Agregar Documento Registrado</h4>',
    'toggleButton' => ['label' => 'Agregar Documento Registrado', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-documento">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form2 = ActiveForm::begin(['id'=>$modelDocumento->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlDocumento, 'options' => ['data-pjax' => true]]); ?>
            <?php  echo '<h1>Cargar Documentos Registrados</h1>'?>
            <?php echo Form::widget([
                'model'=>$modelDocumento,
                'form'=>$form2,
                'columns'=>3,
                'attributes'=>$modelDocumento->formAttribs
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>


<?php Modal::end();?>
    

    <?php $form = ActiveForm::begin([
        'type'=>ActiveForm::TYPE_VERTICAL
  ]); ?>

     <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->formAttribs
      ]); ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
     <?php
$script = <<< JS
        $( document ).ready(function() {
  
    
    $('.field-personasnaturales-sys_pais_id').css('display','none');
    $('.field-personasnaturales-rif').css('display','none');
    $('.field-personasnaturales-numero_identificacion').css('display','none');
        
    $('#personasnaturales-nacionalidad').click(function(e){
                if($('#personasnaturales-nacionalidad').val()=='NACIONAL') {
                     $('.field-personasnaturales-rif').css('display','inherit');
                     $('.field-personasnaturales-sys_pais_id').css('display','none');
                     $('.field-personasnaturales-numero_identificacion').css('display','none');
                     $('#personasnaturales-sys_pais_id').val('');
                     $('#personasnaturales-numero_identificacion').val('');
                  
                }else{
                        if($('#personasnaturales-nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasnaturales-rif').css('display','none');
                        $('.field-personasnaturales-sys_pais_id').css('display','inherit');
                        $('.field-personasnaturales-numero_identificacion').css('display','inherit');
                        $('#personasnaturales-rif').val('');
            
                        }
                     
                       }
                
       
        });
        
        $('.field-personasjuridicas-sys_pais_id').css('display','none');
    $('.field-personasjuridicas-rif').css('display','none');
    $('.field-personasjuridicas-numero_identificacion').css('display','none');
        
    $('#personasjuridicas-tipo_nacionalidad').click(function(e){
                if($('#personasjuridicas-tipo_nacionalidad').val()=='NACIONAL') {
                     $('.field-personasjuridicas-rif').css('display','inherit');
                     $('.field-personasjuridicas-sys_pais_id').css('display','none');
                     $('.field-personasjuridicas-numero_identificacion').css('display','none');
                     $('#personasjuridicas-sys_pais_id').val('');
                     $('#personasjuridicas-numero_identificacion').val('');
                  
                }else{
                        if($('#personasjuridicas-tipo_nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasjuridicas-rif').css('display','none');
                        $('.field-personasjuridicas-sys_pais_id').css('display','inherit');
                        $('.field-personasjuridicas-numero_identificacion').css('display','inherit');
                        $('#personasjuridicas-rif').val('');
            
                        }
                     
                       }
                
       
        });
           $('.field-empresasrelacionadas-documento_registrado_id').css('display','none');
        $('.field-empresasrelacionadas-fecha_inicio').css('display','none');
        $('.field-empresasrelacionadas-fecha_fin').css('display','none');
        
        if(window.location.href.indexOf("update") > -1)
            {
             if($('#empresasrelacionadas-nacionalidad').val()=='EXTRANJERA'){
                    $('.field-empresasrelacionadas-documento_registrado_id').css('display','none');
                    $('.field-empresasrelacionadas-fecha_inicio').css('display','inherit');
                    $('.field-empresasrelacionadas-fecha_fin').css('display','inherit');
                  }else{
               if($('#empresasrelacionadas-nacionalidad').val()=='NACIONAL' && ($('#empresasrelacionadas-tipo_relacion').val()=='ACCIONISTA' || $('#empresasrelacionadas-tipo_relacion').val()=='INVERSION')){
                    $('.field-empresasrelacionadas-documento_registrado_id').css('display','inherit');
                    $('.field-empresasrelacionadas-fecha_inicio').css('display','none');
                    $('.field-empresasrelacionadas-fecha_fin').css('display','none');
                  }
        }

        }
        
         $('#empresasrelacionadas-nacionalidad').click(function(e){
               if($('#empresasrelacionadas-nacionalidad').val()=='EXTRANJERA'){
                    $('.field-empresasrelacionadas-documento_registrado_id').css('display','none');
                    $('.field-empresasrelacionadas-fecha_inicio').css('display','inherit');
                    $('.field-empresasrelacionadas-fecha_fin').css('display','inherit');
                  }else{
               if($('#empresasrelacionadas-nacionalidad').val()=='NACIONAL' && ($('#empresasrelacionadas-tipo_relacion').val()=='ACCIONISTA' || $('#empresasrelacionadas-tipo_relacion').val()=='INVERSION')){
                    $('.field-empresasrelacionadas-documento_registrado_id').css('display','inherit');
                    $('.field-empresasrelacionadas-fecha_inicio').css('display','none');
                    $('.field-empresasrelacionadas-fecha_fin').css('display','none');
                  }
        }
                  
                   });
        
       $('#empresasrelacionadas-tipo_relacion').click(function(e){
               if($('#empresasrelacionadas-nacionalidad').val()=='NACIONAL' && ($('#empresasrelacionadas-tipo_relacion').val()=='ACCIONISTA' || $('#empresasrelacionadas-tipo_relacion').val()=='INVERSION')){
                    $('.field-empresasrelacionadas-documento_registrado_id').css('display','inherit');
                    $('.field-empresasrelacionadas-fecha_inicio').css('display','none');
                    $('.field-empresasrelacionadas-fecha_fin').css('display','none');
                  }else{
                        $('.field-empresasrelacionadas-documento_registrado_id').css('display','none');
                      }
        
                  
                   });
});
JS;
$this->registerJs($script);
?>

</div>
