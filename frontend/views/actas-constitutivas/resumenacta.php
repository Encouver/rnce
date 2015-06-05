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
            <h2><?= Html::a($razon_social->nombre, ['razones-sociales/index'], ['class' => 'profile-link'])?></h2>
        
        <?php } ?>
        
         <?php if(isset($denominacion_comercial)){ ?>
         <table class="table table-bordered">
         <tr class="success">
            <td><b><?= Html::a('Denominacion Comercial :', ['denominaciones-comerciales/index'])?> </b><?=$denominacion_comercial->tipo_denominacion?></td>
        </tr>
       
        </table>
        <?php } ?>
        
         
        <h4><?= Html::a('Datos del Registro', ['activos-documentos-registrados/index'], ['class' => 'profile-link']) ?></h4>
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
            <td><b><?= Html::a('Duracion empresa :', ['duraciones-empresas/index'])?> </b><?= $duracion_empresa->duracion_anos.' Años';?></td>
            <?php } ?>
             <?php if(isset($cierre_ejercicio)){ ?>
            <td><b><?= Html::a('Cierre ejercicio :', ['cierres-ejercicios/index'])?> </b><?= $cierre_ejercicio->fecha_cierre;?></td>
            <?php } ?>
        </tr>
       
        </table>
        
         <?php if(isset($domicilio_fiscal) || isset($domicilio_principal)){ ?>
            <h4><?= Html::a('Direcciones', ['domicilios/index'], ['class' => 'profile-link']) ?></h4>
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
            <h4><?= Html::a('Objeto Social', ['objetos-sociales/index'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
                <tr class="success">
                    <td><?= $objeto_social->descripcion;?></td>
                </tr>
            </table>
        <?php }?>
        <?php if(isset($actividad_economica)){?>
             <h4><?= Html::a('Actividades Economicas', ['actividades-economicas/index'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
                <tr class="success">
              
                    <td><b>Actividad Economica principal: </b><?=$actividad_economica->ppalCaev->denominacion;?></td>
                    <td><b>Experiencia: </b><?= $actividad_economica->ppal_experiencia.' años';?></td>
            
                </tr>
                <tr class="success">
              
                    <td><b>Actividad Economica principal: </b><?= $actividad_economica->comp1Caev->denominacion;?></td>
                    <td><b>Experiencia: </b><?= $actividad_economica->comp1_experiencia.' años';?></td>
            
                </tr>
                <tr class="success">
              
                <td><b>Actividad Economica principal: </b><?= $actividad_economica->comp2Caev->denominacion;?></td>
                <td><b>Experiencia: </b><?= $actividad_economica->comp2_experiencia.' años';?></td>
            
                </tr>
            </table>
        <?php }?>
        <?php if(isset($capital_suscrito)){?>
            <h4><?= Html::a('Capital', ['actas-constitutivas/crearcapitalsuscrito'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
                <tr class="success">
                    <td><b>Capital Suscrito: </b><?= $capital_suscrito->capital;?></td>
                    <td><b>Capital Pagado: </b><?= $capital_pagado->capital;?></td>
                </tr>
       
            </table>
            <table class="table table-bordered">
                <?php if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){?>
                    <tr class="success">
                        <td><b>Numero Acciones suscritas: </b><?= $capital_suscrito->numero_comun;?></td>
                        <td><b>Valor Acciones suscritas:</b><?= $capital_suscrito->valor_comun;?></td>
                        <td><b>Numero Acciones pagadas:</b><?= $capital_pagado->numero_comun;?></td>
                    </tr>
                <?php }else{
                        if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=="SUPLEMENTARIO"){?>
                
                            <tr class="success">
                                <td><b>Numero Certificados Suplementarios suscritos: </b><?= $capital_suscrito->numero;?></td>
                                <td><b>Valor Certificados Suplementarios suscritos: </b><?= $capital_suscrito->valor;?></td>
                                <td><b>Numero Certificados Suplementarios pagados: </b><?= $capital_pagado->numero;?></td>
                            </tr>
                
                        <?php }else{ ?>
                                    <tr class="success">
                                        <td><b>Numero Certificados suscritos asociacion: </b><?= $capital_suscrito->numero_asociacion;?></td>
                                        <td><b>Numero Certificados suscritos aportacion: </b><?= $capital_suscrito->numero_aportacion;?></td>
                                        <td><b>Numero Certificados suscritos inversion: </b><?= $capital_suscrito->numero_inversion;?></td>
                                        <td><b>Numero Certificados suscritos rotativo: </b><?= $capital_suscrito->numero_rotativo;?></td>
                                    </tr>
                                    <tr class="success">
                                        <td><b>Valor Certificados suscritos asociacion: </b><?= $capital_suscrito->valor_asociacion;?></td>
                                        <td><b>Valor Certificados suscritos aportacion: </b><?= $capital_suscrito->valor_aportacion;?></td>
                                        <td><b>Valor Certificados suscritos inversion: </b><?= $capital_suscrito->valor_inversion;?></td>
                                        <td><b>Valor Certificados suscritos rotativo: </b><?= $capital_suscrito->valor_rotativo;?></td>
                                    </tr>
                                    <tr class="success">
                                        <td><b>Numero Certificados pagados asociacion: </b><?= $capital_pagado->numero_asociacion;?></td>
                                        <td><b>Numero Certificados pagados aportacion: </b><?= $capital_pagado->numero_aportacion;?></td>
                                        <td><b>Numero Certificados pagados inversion: </b><?= $capital_pagado->numero_inversion;?></td>
                                        <td><b>Numero Certificados pagados rotativo: </b><?= $capital_pagado->numero_rotativo;?></td>
                                    </tr>
                <?php  } }?>
            </table>
        <?php }?>
        <?php if(isset($origen_capital_efectivo) || isset($origen_capital_banco) || isset($origen_capital_bien)){?>
             <h4><?= Html::a('Origen del Capital', ['origenes-capitales/index'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
                <?php if (isset($origen_capital_efectivo)){
                        foreach ($origen_capital_efectivo as $efectivo) {?>
                            <tr class="success">
                                <td><b>Tipo: </b>EFECTIVO</td>
                                <td><b>Monto: </b><?= $efectivo->monto;?></td>
                            </tr>
                <?php } }?>
                <?php if (isset($origen_capital_banco)){
                        foreach ($origen_capital_banco as $banco) {?>
                            <tr class="success">
                                <td><b>Tipo: </b>BANCO</td>
                                <td><b>Monto: </b><?= $banco->monto;?></td>
                            </tr>
                <?php } }?>
                <?php if (isset($origen_capital_bien)){
                        foreach ($origen_capital_bien as $bien) {?>
                            <tr class="success">
                                <td><b>Tipo: </b>BIEN</td>
                                <td><b>Monto: </b><?= $bien->monto;?></td>
                            </tr>
                <?php } }?>
            </table>
        <?php }?>
        <?php if(isset($certificacion_aporte)){?>
                <h4><?= Html::a('Certificacion de Aporte', ['certificaciones-aportes/index'], ['class' => 'profile-link']) ?></h4>
                <table class="table table-bordered">
                    <tr class="success">
                        <td><b>Nombre: </b><?=$certificacion_aporte->naturalJuridica->denominacion;?></td> 
                        <td><b>Tipo Profesion: </b><?=$certificacion_aporte->tipo_profesion;?></td> 
                    </tr>
                </table>
        <?php }?>
        <?php if (isset($accionista_otro)){?>
                <h4><?= Html::a('Accionistas, Representante Legal y Junta Directiva', ['accionistas-otros/index'], ['class' => 'profile-link']) ?></h4>
                <table class="table table-bordered">
          
                    <?php foreach ($accionista_otro as $accionista) {?>
      
                        <tr class="success">
                            <td><b>Nombre: </b><?= $accionista->naturalJuridica->denominacion;?></td>
                            <td><b>Accionista: </b><?= ($accionista->accionista)?'SI':'NO';?></td>
             
                            <td><b>Representante Legal: </b><?= ($accionista->rep_legal)?'SI':'NO';?></td>
                            <td><b>Junta Directiva: </b><?= ($accionista->junta_directiva)?'SI':'NO';?></td>
             
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
        <?php if (isset($fondo_reserva)){?>
            <h4><?= Html::a('Fondos Reserva', ['fondos-reservas/index'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
          
                <?php foreach ($fondo_reserva as $fondo) {?>
      
                    <tr class="success">
                        <td><b>Nombre: </b><?= $fondo->nombre_fondo;?></td>
                        <td><b>Porcentaje: </b><?= $fondo->porcentaje;?></td>
             
                    </tr>
   
                <?php } ?>
            </table>
        <?php  }?>
        <?php if (isset($sucursal)){?>
           <h4><?= Html::a('Sucursal', ['sucursales/index'], ['class' => 'profile-link']) ?></h4>
            <table class="table table-bordered">
          
                <?php foreach ($sucursal as $sucu) {?>
      
                    <tr class="success">
                        <td><b>Persona contacto: </b><?= $sucu->naturalJuridica->denominacion;?></td>
                        <td><b>Direccion: </b><?= $sucu->direccion->zona.'. '.$sucu->direccion->calle.'. '.$sucu->direccion->casa.'. '.$sucu->direccion->sysEstado->nombre;?></td>
             
                    </tr>
   
                 <?php } ?>
             </table>
        <?php  }?>
        <?php if (!is_null($msgDocumentoRegistrado)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <?= Html::a($msgDocumentoRegistrado, ['activos-documentos-registrados/index'], ['class' => 'profile-link']) ?></h4>

            </div>
         <?php } ?>
        <?php if (!is_null($msgDenominacionComercial)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgDenominacionComercial, ['denominaciones-comerciales/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgRazonSocial)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgRazonSocial, ['razones-sociales/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
         <?php if (!is_null($msgObjetoSocial)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgObjetoSocial, ['objetos-sociales/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
         <?php if (!is_null($msgDomicilioFiscal)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgDomicilioFiscal, ['domicilios/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgDomicilioPrincipal)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgDomicilioPrincipal, ['domicilios/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgCierreEjercicio)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgCierreEjercicio, ['cierres-ejercicios/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgDuracionEmpresa)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgDuracionEmpresa, ['duraciones-empresas/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgActividadEconomica)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgActividadEconomica, ['actividades-economicas/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgCapital)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgCapital, ['actas-constitutivas/crearcapitalsuscrito'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
         <?php if (!is_null($msgOrigenCapital)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgOrigenCapital, ['origenes-capitales/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
         <?php if (!is_null($msgCertificacionAporte)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgCertificacionAporte, ['certificaciones-aportes/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgAccionistaOtro)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgAccionistaOtro, ['accionistas-otros/index'], ['class' => 'profile-link']) ?></h4>

            </div>
         <?php } ?>
         <?php if (!is_null($msgComisario)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgComisario, ['comisarios-auditores/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgFondoReserva)){?>
            <div class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgFondoReserva, ['fondos-reservas/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php if (!is_null($msgSucursal)){?>
            <div class="alert-warning alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <?= Html::a($msgSucursal, ['sucursales/index'], ['class' => 'profile-link']) ?></h4>

            </div>
        <?php } ?>
        <?php  if ($boton){?>
            <p>
                <?= Html::a(Yii::t('app', 'Enviar'), ['createacta'], ['class' => 'btn btn-success']) ?>
            </p>
    <?php } ?>
  <?php } ?>

</div>