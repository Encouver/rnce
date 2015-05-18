<?php
?>
<div class="row">
  <div class="col-md-8">
    <h2><?= $natural_juridica->denominacion ?></h2>
    <hr />

    <table class="table table-bordered">
        <tr>
            <td><b>Duracion Empresa: </b><?= $duracion_empresa->duracion_anos.' Años' ?></td>
            <td><b>Fecha Vencimiento: </b><?= $duracion_empresa->fecha_vencimiento ?></td>
            <td><b>Cierre Ejercicio Economico: </b><?= $cierre_ejercicio->fecha_cierre ?></td>
        </tr>
       
    </table>

     <table class="table table-bordered">
        <tr>
            <td><b>Aciones Suscritas: </b><?= $accion_suscrita->numero_comun?></td>
            <td><b>Valor: </b><?= $accion_suscrita->valor_comun ?></td>
             <td><b>Aciones Pagadas: </b><?= $accion_pagada->numero_comun?></td>
            <td><b>Valor: </b><?= $accion_pagada->valor_comun ?></td>
        </tr>
       
    </table>
    
    <table class="table table-bordered">
        <tr>
            <th>Objeto Social</th>
        </tr>
          <tr>
            <td><?= $objeto_social->descripcion ?></td>
        </tr>
    </table>
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
</div>
</div>