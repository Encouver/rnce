<?php
use yii\helpers\Html;
?>
<div class="row">
   <?php if(isset($registro)){ ?>
    <h2><?php if(isset($razon_social)){ echo $razon_social->nombre;}?></h2>
      <table class="table table-bordered">
         <tr>
            <td><b>Denominacion Comercial: </b><?php if(isset($denominacion_comercial)){ echo $denominacion_comercial->tipo_denominacion;}?></td>
        </tr>
       
    </table>
     <h4>Datos Baicos</h4>
    <table class="table table-bordered">
         
         <tr>
            <td><b>Circunscripcion: </b><?=$registro->sysCircunscripcion->nombre;?></td>
            <td><b>Numero Registro / Notaria: </b><?=$registro->num_registro_notaria;?></td>
            <td><b>Tomo: </b><?=$registro->tomo;?></td>
        </tr>
        <tr>
            <td><b>Folio: </b><?=$registro->folio;?></td>
            <td><b>Fecha Registro: </b><?=$registro->fecha_registro;?></td>
            <td><b>Fecha Asamblea: </b><?=$registro->fecha_asamblea;?></td>
        </tr>
       
    </table>
    <table class="table table-bordered">
        <tr>
            <td><b>Duracion Empresa: </b><?php if(isset($duracion_empresa)){ echo $duracion_empresa->duracion_anos.' Años';}?></td>
            <td><b>Cierre Ejercicio Economico: </b><?php if(isset($cierre_ejercicio)){ echo $cierre_ejercicio->fecha_cierre;}?></td>
        </tr>
       
    </table>
     
      <table class="table table-bordered">
          
  
      <?php if (isset($domicilio_fiscal)){?>
            <tr>
              <td><b>Direccion Fiscal: </b><?= $domicilio_fiscal->direccion->zona.'. '.$domicilio_fiscal->direccion->calle.'. '.$domicilio_fiscal->direccion->casa.'. '.$domicilio_fiscal->direccion->sysEstado->nombre;?></td>
             
            </tr>

        <?php  }?>
            <?php if (isset($domicilio_principal)){?>
            <tr>
              <td><b>Direccion Principal: </b><?= $domicilio_principal->direccion->zona.'. '.$domicilio_principal->direccion->calle.'. '.$domicilio_principal->direccion->casa.'. '.$domicilio_principal->direccion->sysEstado->nombre;?></td>
             
            </tr>

        <?php  }?>
             
    
    </table>
    
    
     <?php if(isset($objeto_social)){?>
    <table class="table table-bordered">
       
          <tr>
            <td><b>Objeto Social: </b><?= $objeto_social->descripcion ?></td>
        </tr>
    </table>
       <?php }?>
     <?php if(isset($actividad_economica)){?>
     <h4>Actividades Economicas</h4>
     <table class="table table-bordered">
          <tr>
              
             <td><b>Actividad Economica principal: </b><?=$actividad_economica->ppalCaev->denominacion?></td>
            <td><b>Experiencia: </b><?= $actividad_economica->ppal_experiencia.' años'?></td>
            
            </tr>
            <tr>
              
             <td><b>Actividad Economica principal: </b><?= $actividad_economica->comp1Caev->denominacion?></td>
            <td><b>Experiencia: </b><?= $actividad_economica->comp1_experiencia.' años'?></td>
            
            </tr>
            <tr>
              
             <td><b>Actividad Economica principal: </b><?= $actividad_economica->comp2Caev->denominacion ?></td>
            <td><b>Experiencia: </b><?= $actividad_economica->comp2_experiencia.' años'?></td>
            
            </tr>
    </table>
     <?php }?>
    <?php if(isset($denominacion_comercial) && isset($capital_suscrito)){?>
     <h4>Capital</h4>
      <table class="table table-bordered">
        <tr>
            <td><b>Capital Suscrito: </b><?= $capital_suscrito->capital;?></td>
            <td><b>Capital Pagado: </b><?= $capital_pagado->capital;?></td>
        </tr>
       
    </table>
     <table class="table table-bordered">
          <?php if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){?>
           <tr>
            <td><b>Numero Acciones suscritas: </b><?= $capital_suscrito->numero_comun;?></td>
            <td><b>Valor Acciones suscritas:</b><?= $capital_suscrito->valor_comun;?></td>
            <td><b>Numero Acciones pagadas:</b><?= $capital_pagado->numero_comun;?></td>
         </tr>
            <?php }else{
                if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=="SUPLEMENTARIO"){?>
                
            <tr>
            <td><b>Numero Certificados Suplementarios suscritos: </b><?= $capital_suscrito->numero;?></td>
            <td><b>Valor Certificados Suplementarios suscritos: </b><?= $capital_suscrito->valor;?></td>
            <td><b>Numero Certificados Suplementarios pagados: </b><?= $capital_pagado->numero;?></td>
         </tr>
                
        <?php }else{ ?>
            <tr>
            <td><b>Numero Certificados suscritos asociacion: </b><?= $capital_suscrito->numero_asociacion;?></td>
            <td><b>Numero Certificados suscritos aportacion: </b><?= $capital_suscrito->numero_aportacion;?></td>
            <td><b>Numero Certificados suscritos inversion:</b><?= $capital_suscrito->numero_inversion;?></td>
            <td><b>Numero Certificados suscritos rotativo:</b><?= $capital_suscrito->numero_rotativo;?></td>
         </tr>
          <tr>
            <td><b>Valor Certificados suscritos asociacion: </b><?= $capital_suscrito->valor_asociacion;?></td>
            <td><b>Valor Certificados suscritos aportacion: </b><?= $capital_suscrito->valor_aportacion;?></td>
            <td><b>Valor Certificados suscritos inversion:</b><?= $capital_suscrito->valor_inversion;?></td>
            <td><b>Valor Certificados suscritos rotativo:</b><?= $capital_suscrito->valor_rotativo;?></td>
         </tr>
         <tr>
            <td><b>Numero Certificados pagados asociacion: </b><?= $capital_pagado->numero_asociacion;?></td>
            <td><b>Numero Certificados pagados aportacion: </b><?= $capital_pagado->numero_aportacion;?></td>
            <td><b>Numero Certificados pagados inversion:</b><?= $capital_pagado->numero_inversion;?></td>
            <td><b>Numero Certificados pagados rotativo:</b><?= $capital_pagado->numero_rotativo;?></td>
         </tr>
       <?php  } }?>
    </table>
   
    
    <?php }?>
     <h4>Origen Capital</h4>
      <table class="table table-bordered">
          
           <?php if (isset($origen_capital_efectivo)){
               foreach ($origen_capital_efectivo as $efectivo) {?>
        <tr>
            <td><b>Tipo: </b>EFECTIVO</td>
            <td><b>Monto: </b><?= $efectivo->monto;?></td>
        </tr>
              <?php } }?>
       <?php if (isset($origen_capital_banco)){
               foreach ($origen_capital_banco as $banco) {?>
        <tr>
            <td><b>Tipo: </b>BANCO</td>
            <td><b>Monto: </b><?= $banco->monto;?></td>
        </tr>
              <?php } }?>
         <?php if (isset($origen_capital_bien)){
               foreach ($origen_capital_bien as $bien) {?>
        <tr>
            <td><b>Tipo: </b>BIEN</td>
            <td><b>Monto: </b><?= $bien->monto;?></td>
        </tr>
              <?php } }?>
    
    </table>
     <?php if(isset($origen_capital_banco)){?>
      <table class="table table-bordered">
           
    
    </table>
    <?php }?>
     <?php if(isset($certificacion_aporte)){?>
    <h4>Certificacion aportes</h4>
     <table class="table table-bordered">
                  <tr>
              <td><b>Nombre: </b><?=$certificacion_aporte->naturalJuridica->denominacion;?></td> 
            <td><b>Tipo Profesion: </b><?=$certificacion_aporte->tipo_profesion;?></td> 
            </tr>
    </table>
     <?php }?>
      <?php if (isset($accionista_otro)){?>
    <h4>Accionistas, Representante Legal y Junta Directiva</h4>
      <table class="table table-bordered">
          
           <?php foreach ($accionista_otro as $accionista) {?>
      
            <tr>
            <td><b>Nombre: </b><?= $accionista->naturalJuridica->denominacion;?></td>
            <td><b>Accionista: </b><?= ($accionista->accionista)?'Si':'NO';?></td>
             
             <td><b>Representante Legal: </b><?= ($accionista->rep_legal)?'Si':'NO';?></td>
             <td><b>Junta Directiva: </b><?= ($accionista->junta_directiva)?'Si':'NO';?></td>
             
            </tr>
   
              <?php } ?>
       
             
    
    </table>
    
     <?php  }?>
     <?php if (isset($comisario)){?>
    <h4>Comisarios</h4>
      <table class="table table-bordered">
          
           <?php foreach ($comisario as $com) {?>
      
            <tr>
            <td><b>Nombre: </b><?= $com->naturalJuridica->denominacion;?></td>
            <td><b>Tipo Profesion: </b><?= $com->tipo_profesion;?></td>
             
            </tr>
   
              <?php } ?>
       
             
    
    </table>
    
     <?php  }?>
    <?php if (isset($fondo_reserva)){?>
    <h4>Fondos Reservas</h4>
      <table class="table table-bordered">
          
           <?php foreach ($fondo_reserva as $fondo) {?>
      
            <tr>
            <td><b>Nombre: </b><?= $fondo->nombre_fondo;?></td>
            <td><b>Porcentaje: </b><?= $fondo->porcentaje;?></td>
             
            </tr>
   
              <?php } ?>
       
             
    
    </table>
    
     <?php  }?>
     <?php if (isset($sucursal)){?>
    <h4>Sucursales</h4>
      <table class="table table-bordered">
          
           <?php foreach ($sucursal as $sucu) {?>
      
            <tr>
            <td><b>Persona contacto: </b><?= $sucu->naturalJuridica->denominacion;?></td>
            <td><b>Direccion: </b><?= $sucu->direccion->zona.'. '.$sucu->direccion->calle.'. '.$sucu->direccion->casa.'. '.$sucu->direccion->sysEstado->nombre;?></td>
             
            </tr>
   
              <?php } ?>
       
             
    
    </table>
    
     <?php  }?>
      <p>
        <?= Html::a(Yii::t('app', 'Enviar'), ['createacta'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
</div>