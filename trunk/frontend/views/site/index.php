<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
?>
<div class="site-index">
    <?php 
        NavBar::begin(['brandLabel' => '']);
        echo Nav::widget([
            'items' => [
                ['label' => 'Efectivo Caja', 'url' => ['/efectivo-caja/index']],
                ['label' => 'Efectivo Banco', 'url' => ['/efectivo-banco/index']],
                ['label' => 'Tipo Caja', 'url' => ['/tipos-cajas/index']],
                ['label' => 'Inversiones', 'url' => ['/inversiones/index']],
                ['label' => 'Bancos Contratistas', 'url' => ['/bancos-contratistas/index']],
                ['label' => 'Tipos inversiones', 'url' => ['/tipos-inversiones/index']],
                ['label' => 'Cuentas por cobrar comerciales', 'url' => ['/cuentas-cobrar-sprivpub/index']],
                ['label' => 'Otras cuentas cobrar', 'url' => ['/otras-cuentas-cobrar/index']],
                ['label' => 'Tipos Deudores', 'url' => ['/tipos-deudores/index']],
                ['label' => 'Representantes legales', 'url' => ['/reps-legales/index']],
                ['label' => 'Empresas Relacionadas', 'url' => ['/empresas-relacionadas/index']],
                ['label' => 'Inventarios C', 'url' => ['/inventarios-c/index']],
                //['label' => 'Tipos inversiones', 'url' => ['/tipos-inversiones/index']],
            ],
        ]);
        NavBar::end();

    ?>

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

        <h2> BALANCE GENERAL</h2>
        <?=  $this->render('_activos'); ?> 
        <?=  $this->render('_pasivos'); ?>
        <br><br><br>
        <h2> ESTADO DE RESULTADOS</h2>
        <?=  $this->render('_resultados'); ?>

</div>
