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
use webvimark\modules\UserManagement\components\GhostNav;
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
                    'class' => 'navbar-inverse navbar-fixed-top ',
                ],
            ]);
            $menuItems = [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Módulo financiero',
                    'items' => [
                         ['label' => 'Balance general', 'url' => ['/site/balancegeneral']],
                         ['label' => 'Estado de resultados', 'url' => ['/site/edoresultados']],
                         ['label' => 'Efectivos y sus equivalentes', 'url' => ['/aefectivos-bancos/efectivosequivalentes']],
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
                         ['label' => 'Acordeon', 'url' => ['/contratistas/acordeon']],
                         ['label' => 'Informacion de contacto', 'url' => ['/contratistas-contactos/index']],
                         ['label' => 'Direccion Principal', 'url' => ['/domicilios/index']],
                         ['label' => 'Sucursales', 'url' => ['/sucursales/index']],
                         ['label' => 'Bancos', 'url' => ['/bancos-contratistas/index']],
                         ['label' => 'Relaciones contratos', 'url' => ['/relaciones-contratos/index']],
                         ['label' => 'Principios Contables', 'url' => ['/principios-contables/index']],
                        ['label' => 'Actividades Economicas', 'url' => ['/actividades-economicas/index']],
                    ],
                ],
                 ['label' => 'Acta Constitutiva',
                    'items' => [
                         ['label' => 'Registro documento', 'url' => ['/documentos-registrados/index']],
                        ['label' => 'Objeto Social', 'url' => ['/objetos-sociales/index']],
                        ['label' => 'Cierre ejercicio', 'url' => ['/cierres-ejercicios/index']],
                        ['label' => 'Duracion empresa', 'url' => ['/duraciones-empresas/index']],
                    ],
                ],
                
            ];

            // Items del menu de usuario
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Registrate',  'url' => ['/user-management/auth/registration']];//['/site/signup']];
                $menuItems[] = ['label' => 'Iniciar sesión', 'url' => ['/user-management/auth/login']];//['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Cerrar sesión (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user-management/auth/logout'],//['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            //$menuItems[]= ['label'=>'Registrate', 'url'=>['/user-management/auth/registration']];
           // $menuItems[]= ['label'=>'Iniciar sesion', 'url'=>['/user-management/auth/login']];
            //$menuItems[]= ['label'=>'Cerrar sesion', 'url'=>['/user-management/auth/logout']];

            $menuItems[] =
                [
                    'label' => 'Administrar Usuarios',
                    'items'=>UserManagementModule::menuItems()
                ];
            $menuItems[] =  [
                        'label' => 'Perfil',
                        'items'=>[
                            ['label'=>'Cambiar contraseña', 'url'=>['/user-management/auth/change-own-password']],
                            ['label'=>'Recuperar contraseña', 'url'=>['/user-management/auth/password-recovery']],
                            ['label'=>'Confirmar E-mail', 'url'=>['/user-management/auth/confirm-email']],
                        ],
                    ];

            echo GhostNav::widget([
                'encodeLabels'=>false,
                'activateParents'=>false,
                'items' => $menuItems,
                'options' => ['class' =>'navbar-nav navbar-right'],
            ]);
           /* echo Nav::widget([
                'encodeLabels'=>false,
                'activateParents'=>false,
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);*/
            NavBar::end();

        ?>
<div class="container"></div>
        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php

        use kartik\tabs\TabsX;
        $item = [
            [
                'label'=>'<i class="glyphicon glyphicon-home"></i> Corrientes',
                'content'=> 'A',
                'active'=>true
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-user"></i> No corrientes',
                'content'=>'',
                'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/tabs-data'])]
            ],

        ];

        $items = [
            [
                'label'=>'<i class="glyphicon glyphicon-home"></i> Cuentas Activos',
                'content'=>TabsX::widget([
                    'items'=>$item,
                    'position'=>TabsX::POS_ABOVE,
                    'bordered'=>false,
                    'encodeLabels'=>false
                ]),
                'active'=>true
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-user"></i> Cuentas Pasivos',
                'content'=>TabsX::widget([
                    'items'=>$item,
                    'position'=>TabsX::POS_ABOVE,
                    'bordered'=>false,
                    'encodeLabels'=>false
                ]),
                //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/tabs-data'])]
            ],
            /*[
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Cuentas Patrimonio',
                'items'=>[
                    [
                        'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                        'encode'=>false,
                        'items'=>TabsX::widget([
                            'items'=>$item,
                            'position'=>TabsX::POS_ABOVE,
                            'bordered'=>false,
                            'encodeLabels'=>false
                        ]),
                    ],
                    [
                        'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                        'encode'=>false,
                        'items'=>TabsX::widget([
                            'items'=>$item,
                            'position'=>TabsX::POS_ABOVE,
                            'bordered'=>false,
                            'encodeLabels'=>false
                        ]),
                    ],
                ],
            ],*/
        ];


        // Above
        echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
            'options' => ['class' =>'nav-tabs '],
        ]);

       /* echo GhostNav::widget([
                'encodeLabels'=>false,
                'activateParents'=>false,
                'items' => [
                    [
                        'label' => 'Administrar Usuarios',
                        'items'=>UserManagementModule::menuItems()
                    ],
                    [
                        'label' => 'Perfil',
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
            'options' => ['class' =>'nav-pills'],
            ]);*/
        ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Registro Nacional de Contrataciones <?= date('Y') ?></p>
        <p class="pull-right"><?php // Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

