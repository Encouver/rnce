<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\DatePicker;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrarE */
/* @var $form yii\widgets\ActiveForm */

?>
<style type="text/css">
#corriente, #nocorriente 
{
    display: none;
}
</style>

<?= Yii::$app->session->getFlash('error'); ?>

<div class="cuentas-b2-otras-cuentas-por-cobrar-e-form">
<?php
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs()
    ]);
?>
<div id="corriente">
    <h4>Corriente</h4>
<?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        //'columns'=>11,
        'attributes'=> $model->getFormA()
    ]);
?>
</div>
<div id="nocorriente">
    <h4>No corriente</h4>
<?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        //'columns'=>11,
        'attributes'=> $model->getFormB()
    ]);
?>
</div>
    <?php
        echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
        ActiveForm::end();
    ?>  
</div>


<?php
$script = <<< JS
$( document ).ready(function() {

    $('#cuentasb2otrascuentasporcobrare-deterioro_c').click(function ()
    {
        if($('#cuentasb2otrascuentasporcobrare-deterioro_c').is(':checked'))
            $('#modal').modal('show');
    });


    $('#cuentasb2otrascuentasporcobrare-otro_nombre').prop('disabled', true);

    $('#cuentasb2otrascuentasporcobrare-corriente').click(function() {
        if($('#cuentasb2otrascuentasporcobrare-corriente').is(':checked'))
        {
           var checked = $('#cuentasb2otrascuentasporcobrare-corriente').attr('checked');
            if (checked) {
                $(this).removeAttr('checked');
            }else{
                $(this).attr('checked', '');
            }

           $('#corriente').css('display', 'inherit');
        }else
        {
            $('#cuentasb2otrascuentasporcobrare-corriente').removeAttr('checked');
            $('#corriente').css('display', 'none');
        }
    });

    $('#cuentasb2otrascuentasporcobrare-nocorriente').click(function() {
        if($('#cuentasb2otrascuentasporcobrare-nocorriente').is(':checked'))
        {
         var checked = $('#cuentasb2otrascuentasporcobrare-nocorriente').attr('checked');
            if (checked) {
                $(this).removeAttr('checked');
            }else{
                $(this).attr('checked', '');
            }

           $('#nocorriente').css('display', 'inherit');
        }else
        {
            $('#cuentasb2otrascuentasporcobrare-nocorriente').removeAttr('checked');
            $('#nocorriente').css('display', 'none');
        }
    });


    $('#cuentasb2otrascuentasporcobrare-deterioro_nc').click(function() {
        if($('#cuentasb2otrascuentasporcobrare-deterioro_nc').is(':checked'))
        {
            //alert("hola");
        }
    });

    
    $('#cuentasb2otrascuentasporcobrare-criterio').click(function() {
        if($('#cuentasb2otrascuentasporcobrare-criterio').val()==1)
        {
            /*$('.field-cuentasb2otrascuentasporcobrare-empresa_id').css('display', 'inherit');
            $('.field-cuentasb2otrascuentasporcobrare-otro_nombre').css('display', 'none');*/

            $('#cuentasb2otrascuentasporcobrare-otro_nombre').prop('disabled', true);
            $('#cuentasb2otrascuentasporcobrare-empresa_id').prop('disabled', false);

        }else
        {
            /*$('.field-cuentasb2otrascuentasporcobrare-empresa_id').css('display', 'none');
            $('.field-cuentasb2otrascuentasporcobrare-otro_nombre').css('display', 'inherit');*/

            $('#cuentasb2otrascuentasporcobrare-otro_nombre').prop('disabled', false);
            $('#cuentasb2otrascuentasporcobrare-empresa_id').prop('disabled', true);
        }
    });
});

JS;
$this->registerJs($script);
?>

 <?php


    Modal::begin([
        //'header' => '<h4>Probando</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    
        echo $this->render('/activos-sys-metodos-medicion/capas');

    Modal::end();

$script = <<< JS
    $('form').on('beforeSubmit', function(e)
    {
        var \$form = $(this);
        $.post(
            \$form.attr("action"), \$form.serialize()
        ).done(function(result)
        {
            //$('#propo').attr('checked', 'checked');
            $('#cuentasb2otrascuentasporcobrare-valor_de_uso_c').val(result);
            $('#modal').modal('hide');  
        }).fail(function()
        {
            console.log("error");
        })
        return false;
    });
JS;
    $this->registerJs($script);
?>

