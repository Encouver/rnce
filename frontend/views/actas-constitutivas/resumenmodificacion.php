<?php
use yii\helpers\Html;
?>
<style>
    .tamaño{
        width:80%;
        margin: 0 auto;
        max-width: 80%;
    }
</style>
<div class="tamaño">

    <?php if(isset($registro)){ ?>
        <?php if(isset($razon_social)){?>
            <h2><?= Html::a($razon_social->nombre, ['razones-sociales/modificacion'], ['class' => 'profile-link'])?></h2>
        
        <?php } ?>
        
         <?php if(isset($denominacion_comercial)){ ?>
         <table class="table table-bordered">
         <tr class="success">
            <td><b><?= Html::a('Denominacion Comercial :', ['denominaciones-comerciales/modificacion'])?> </b><?=$denominacion_comercial->tipo_denominacion?></td>
        </tr>
       
        </table>
        <?php } ?>
        
         
        <h4><?= Html::a('Datos del Registro', ['activos-documentos-registrados/modificacion'], ['class' => 'profile-link']) ?></h4>
        <table class="table table-bordered">
         
         <tr class="success">
            <td><b>Circunscripcion: </b><?=$registro->sysCircunscripcion->nombre;?></td>
            <td><b>Numero Registro / Notaria: </b><?=$registro->num_registro_notaria;?></td>
            <td><b>Tomo: </b><?=$registro->tomo;?></td>
        </tr>
        <tr class="success">
            <td><b>Folio: </b><?=$registro->folio;?></td>
            <td><b>Fecha Registro: </b><?=$registro->fecha_registro;?></td>
            <td><b>Fecha Asamblea: </b><?=$registro->fecha_asamblea;?></td>
        </tr>
        </table>
        
        <table class="table table-bordered">
        <tr class="success">
             <?php if(isset($duracion_empresa)){ ?>
            <td><b><?= Html::a('Duracion empresa :', ['duraciones-empresas/modificacion'])?> </b><?= $duracion_empresa->duracion_anos.' Años';?></td>
            <?php } ?>
             <?php if(isset($cierre_ejercicio)){ ?>
            <td><b><?= Html::a('Cierre ejercicio :', ['cierres-ejercicios/modificacion'])?> </b><?= $cierre_ejercicio->fecha_cierre;?></td>
            <?php } ?>
        </tr>
       
        </table>
        
         <?php if(isset($domicilio_fiscal) || isset($domicilio_principal)){ ?>
            <h4><?= Html::a('Direcciones', ['domicilios/modificacion'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
                <tr class="success">
                    <?php if(isset($domicilio_fiscal)){ ?>
                        <td><b>Direccion Fiscal : </b><?= $domicilio_fiscal->direccion->zona.'. '.$domicilio_fiscal->direccion->calle.'. '.$domicilio_fiscal->direccion->casa.'. '.$domicilio_fiscal->direccion->sysEstado->nombre;?></td>
                    <?php } ?>
                    <?php if(isset($domicilio_principal)){ ?>
                        <td><b>Direccion Principal : </b><?= $domicilio_principal->direccion->zona.'. '.$domicilio_principal->direccion->calle.'. '.$domicilio_principal->direccion->casa.'. '.$domicilio_principal->direccion->sysEstado->nombre;?></td>
                    <?php } ?>
                   </tr>
            </table>
        <?php } ?>
        <?php if(isset($objeto_social)){?>
            <h4><?= Html::a('Objeto Social', ['objetos-sociales/modificacion'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
                <tr class="success">
                    <td><?= $objeto_social->descripcion;?></td>
                </tr>
            </table>
        <?php }?>
      
        <?php if (isset($representante_legal)){?>
                <h4><?= Html::a('Representante Legal', ['accionistas-otros/representante'], ['class' => 'profile-link']) ?></h4>
                <table class="table table-bordered">
          
      
                        <tr class="success">
                            <td><b>Nombre: </b><?= $representante_legal->naturalJuridica->denominacion;?></td>
                            <td><b>Fecha Vigencia: </b><?= $representante_legal->repr_legal_vigencia;?></td>
                        </tr>
   
                </table>
         <?php  }?>
         <?php if (isset($junta_directiva)){?>
                <h4><?= Html::a('Junta Directiva', ['accionistas-otros/junta'], ['class' => 'profile-link']) ?></h4>
                <table class="table table-bordered">
          
                    <?php foreach ($junta_directiva as $junta) {?>
      
                        <tr class="success">
                            <td><b>Nombre: </b><?= $junta->naturalJuridica->denominacion;?></td>
                            <td><b>Tipo de Cargo: </b><?=  $junta->tipo_cargo;?></td>
                        </tr>
   
                    <?php } ?>
                </table>
         <?php  }?>
        <?php if (isset($comisario)){?>
                <h4><?= Html::a('Comisarios', ['comisarios-auditores/index'], ['class' => 'profile-link']) ?></h4>
                <table class="table table-bordered">
          
                    <?php foreach ($comisario as $com) {?>
      
                        <tr class="success">
                            <td><b>Nombre: </b><?= $com->naturalJuridica->denominacion;?></td>
                            <td><b>Tipo Profesion: </b><?= $com->tipo_profesion;?></td>
             
                        </tr>
   
        <?php } ?>
       
             
    
            </table>
    
        <?php  }?>
      
       
        <?php  if ($boton){?>
            <p>
                <?= Html::a(Yii::t('app', 'Enviar'), ['createacta'], ['class' => 'btn btn-success']) ?>
            </p>
    <?php } ?>
  <?php } ?>

</div>