<?php
/* @var $this yii\web\View */
$this->title = 'Registro Nacional de Contratistas -- Inicio';

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

?>

<div class="site-index">
    <?php 

/*        NavBar::begin(['brandLabel' => '']);

        echo Nav::widget([
            'items' => [
                ['label' => 'Bienes', 'url' => ['bienes/index']],
                // ['label' => 'Efectivo Banco', 'url' => ['/efectivo-banco/index']],
                // ['label' => 'Tipo Caja', 'url' => ['/tipos-cajas/index']],
                // ['label' => 'Inversiones', 'url' => ['/inversiones/index']],
                // ['label' => 'Bancos Contratistas', 'url' => ['/bancos-contratistas/index']],
                // ['label' => 'Tipos inversiones', 'url' => ['/tipos-inversiones/index']],
                // ['label' => 'Cuentas por cobrar comerciales', 'url' => ['/cuentas-cobrar-sprivpub/index']],
                // ['label' => 'Otras cuentas cobrar', 'url' => ['/otras-cuentas-cobrar/index']],
                // ['label' => 'Tipos Deudores', 'url' => ['/tipos-deudores/index']],
                // ['label' => 'Representantes legales', 'url' => ['/reps-legales/index']],
                // ['label' => 'Empresas Relacionadas', 'url' => ['/empresas-relacionadas/index']],
                // ['label' => 'Inventarios C', 'url' => ['/inventarios-c/index']],
                // //['label' => 'Tipos inversiones', 'url' => ['/tipos-inversiones/index']],
            ],
        ]);
        NavBar::end();*/


        ?>
        <!--
<h1 style="text-align:center;">MÓDULO FINANCIERO</h1>

<?php
/*
echo Yii::$app->formatter->asPercent(0.125, 2); // output: 12.50%
echo "<br>";
echo Yii::$app->formatter->asEmail('cebe@example.com'); // output: <a href="mailto:cebe@example.com">cebe@example.com</a>
echo "<br>";
echo Yii::$app->formatter->asBoolean(true); // output: Yes
echo "<br>";
// it also handles display of null values:
echo Yii::$app->formatter->asDate(null); // output: (Not set)
echo "<br>";
        //Yii::$app->formatter->locale = 'es-MX';
echo Yii::$app->formatter->asDate('2014-12-20'); // output: January 1, 2014
echo "<br>";
echo Yii::$app->formatter->asTime(1412599260); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asDateTime('2014-10-06 12:41:00'); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asTime('2014-10-06 14:41:00 CEST'); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asDecimal(20000000000.66464565,2); // 14:41:00
echo "<br>";
//echo Yii::$app->formatter->asCurrency(1412599260); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asTime(1412599260); // 14:41:00
echo "<br>";
/*echo "<br>";
Yii::$app->formatter->locale = 'de-DE';
echo Yii::$app->formatter->asDate('2014-01-01'); // output: 1. Januar 2014
echo "<br>";
Yii::$app->formatter->locale = 'ru-RU';
echo Yii::$app->formatter->asDate('2014-01-01'); // output: 1 января 2014 г.*/

    ?>
    <?php

    $begin = new \common\components\MyDateTime( '2012-03-31' );
    $begin->modify('-1 year +1 day');
    $end = new \common\components\MyDateTime( '2012-03-31' );
    $end->modify( '+1 days' );

/*    echo 'Fecha inicio: '.$begin->format('Y-m-d');
    echo '<br> Fecha Fin: '.$end->format('Y-m-d');
    echo '<br>';*/
    $interval = new DateInterval('P1M');
    $daterange = new DatePeriod($begin, $interval ,$end);

    $atClose = new \common\components\MyDateTime('2015-12-31');
    $result = $atClose->cycleYear();
    echo '<br> Fecha inicio: '.$result['start']->format('Y-m-d');
    echo '<br> Fecha Fin: '.$result['end']->format('Y-m-d');
    echo '<br>';
/*    var_dump(date(DATE_RFC3339, $result['start']));
    echo '<br>';
    var_dump(date(DATE_RFC3339, $result['end']));*/
/*    foreach($daterange as $date){
        echo $date->format("Ymd") . "<br>";
    }*/

    $mydate = new \common\components\MyDateTime();
    $mydate->setDate(2015,01,25);

    $result = $mydate->fiscalYear();
    echo '<br> Fecha inicio: '.$result['start']->format('Y-m-d');
    echo '<br> Fecha Fin: '.$result['end']->format('Y-m-d');
    echo '<br>';
    //var_dump(date(DATE_RFC3339, $result['start']));
    //var_dump(date(DATE_RFC3339, $result['end']));


/*

    if($start > $end){
        $partialStart2 = ((new DateTime)->format('Y')+1).'-01-01';
        $partialEnd = ((new DateTime)->format('Y')+1).'-01-15';
        $start2 = new \common\components\MyDateTime($partialStart2);
        $end = new \common\components\MyDateTime($partialEnd);

//$interval->
        $interval = $start2->diff($end);
        echo '<br>';
        echo $interval->format('%R%a days');
        $start->sub($interval);
        $end->sub($interval);
        $end->modify('-1 days');
        $now = new \common\components\MyDateTime();
        $now->sub($interval);

        if($start >= $now && $now <= $end){

        }
    }*/

    $result = (new \common\components\MyDateTime())->systemYear();

    echo '<br>';
    echo 'Fecha de Inicio: '.$result['start']->format('Y-m-d');
    echo '<br>';
    echo 'Fecha Final: '.$result['end']->format('Y-m-d');


    ?> -->
    <!-- <div class="jumbotron">
        <h1>Congratulations!</h1>
    
        <p class="lead">You have successfully created your Yii-powered application.</p>
    
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
    
    <div class="body-content">
    
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>
    
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
    
                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>
    
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
    
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>
    
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
    
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
    
    </div> -->
</div>