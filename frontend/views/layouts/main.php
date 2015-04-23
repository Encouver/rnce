<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

use kartik\nav\NavX;


use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Registro Nacional de Contratistas',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Módulo financiero',
                    'items' => [
                         ['label' => 'Balance general', 'url' => ['/site/balancegeneral']],
                         ['label' => 'Estado de resultados', 'url' => ['/site/edoresultados']],
                         ['label' => 'Efectivos y sus equivalentes', 'url' => ['/nombres-cajas/efectivosequivalentes']],
                    ],
                ],
                ['label' => 'Bienes',
                    'items' => [
                         ['label' => 'Crear bien', 'url' => ['/bienes/create']],
                         ['label' => 'Activos', 'url' => ['/activos/index']],
                         ['label' => 'Aqui van los otros', 'url' => ['#']],
                    ],
                ],
                ['label' => 'Información general',
                    'items' => [
                         ['label' => 'Aqui van las cosas', 'url' => ['#']],
                    ],
                ],
                ['label' => 'Contratistas',
                    'items' => [
                         ['label' => 'Datos basicos', 'url' => ['/contratistas/index']],
                         ['label' => 'Informacion de contacto', 'url' => ['/contratistas-contactos/index']],
                         ['label' => 'Direccion Principal', 'url' => ['/domicilios/index']],
                         ['label' => 'Sucursales', 'url' => ['/sucursales/index']],
                    ],
                ],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Registrate',  'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Iniciar sesión', 'url' => ['/user-management/auth/login']];//['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Cerrar sesión (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            $menuItems[] = GhostMenu::widget([
                'encodeLabels'=>false,
                'activateParents'=>true,
                'items' => [
                    [
                        'label' => 'Backend routes',
                        'items'=>UserManagementModule::menuItems()
                    ],
                    [
                        'label' => 'Frontend routes',
                        'items'=>[
                            ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                            ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                            ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                            ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                            ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                            ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
                        ],
                    ],
                ],
            ]);
    
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php 
             GhostMenu::widget([
                'encodeLabels'=>false,
                'activateParents'=>true,
                'items' => [
                    [
                        'label' => 'Backend routes',
                        'items'=>UserManagementModule::menuItems()
                    ],
                    [
                        'label' => 'Frontend routes',
                        'items'=>[
                            ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                            ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                            ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                            ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                            ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                            ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
                        ],
                    ],
                ],
            ]);
        ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Registro Nacional de Contratistas <?= date('Y') ?></p>
        <p class="pull-right"><?php // Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

