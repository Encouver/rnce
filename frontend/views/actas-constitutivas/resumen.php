<?php

?>

<div class="col-md-9 center-block">
    <h2><?= $natural_juridica->denominacion ?></h2>
    <hr />
    
</div>

<div class="col-sm-10">
    <dl class="dl-horizontal">
        <dt>Duracion:</dt>
            <dd><?= $duracion_empresa->duracion_anos.' Años' ?></dd>
        <dt>Fecha de Vencimiento:</dt>
            <dd><?= $duracion_empresa->fecha_vencimiento ?></dd>
        <dt>Cierre Ejercicio Economico:</dt>
            <dd><?= $cierre_ejercicio->fecha_cierre ?></dd>
         <dt>Objeto Social:</dt>
            <dd><?= $objeto_social->descripcion ?></dd>
    </dl>
  
</div>

