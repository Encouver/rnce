<?php

use yii\helpers\Html;
use yii\jui\Accordion;
use common\models\p\Direcciones;
use common\models\p\PersonasNaturales;
use common\models\p\BancosContratistas;
use common\models\p\RelacionesSucursales;
use common\models\p\ActividadesEconomicas;
use app\base\Model;
use yii\web\Response;

/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */

$this->title = Yii::t('app', 'Crud Contratistas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$direccion = new Direcciones();
$persona_natural = new PersonasNaturales();
$actividad_economica = new ActividadesEconomicas();

?>
<div class="contratistas-acordion">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Accordion::widget([
    'items' => [
        [
            'header' => 'Datos basicos',
            'content' => $this->render('datos_basicos'),
        ],
        [
            'header' => 'Direccion principal',
            'content' => $this->render('_direcciones_principales',['direccion' => $direccion]),
        ],
         [
            'header' => 'Persona de contacto',
            'content' => $this->render('_personas_contactos',['persona_natural' => $persona_natural]),
        ],
          [
            'header' => 'Sucursales',
            'content' => $this->render('_sucursales',['relacion_sucursal' => (empty($relacion_sucursal)) ? [new RelacionesSucursales()] : $relacion_sucursal]),
        ],
         [
            'header' => 'Bancos',
            'content' => $this->render('_bancos_contratistas',['banco_contratista' => (empty($banco_contratista)) ? [new BancosContratistas] : $banco_contratista]),
        ],
        [
            'header' => 'Actividades economicas',
            'content' => $this->render('_actividades_economicas',['actividad_economica' => $actividad_economica]),
        ],
        [
            'header' => 'Section 3',
            'headerOptions' => ['tag' => 'h3'],
            'content' => 'Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus...',
            'options' => ['tag' => 'div'],
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['tag' => 'h3'],
    'clientOptions' => ['collapsible' => true],
]);?>
    
</div>
