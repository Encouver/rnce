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
use common\models\p\ModificacionesActas;
use common\models\a\ActivosDocumentosRegistrados;

$documentos = null;
$acta = null;
$modificaciones = null;
if(!Yii::$app->user->isGuest)
$acta = ActivosDocumentosRegistrados::find()->where('contratista_id = :contratista and tipo_documento_id = :tipo_documento_id and  proceso_finalizado = :proceso_finalizado', ['contratista'=>Yii::$app->user->identity->contratista_id, 'tipo_documento_id'=>1, 'proceso_finalizado' => true])->one();
if($acta){
$documentos = ActivosDocumentosRegistrados::find()->where('contratista_id = :contratista and tipo_documento_id = :tipo_documento_id and  proceso_finalizado = :proceso_finalizado', ['contratista'=>Yii::$app->user->identity->contratista_id, 'tipo_documento_id'=>2, 'proceso_finalizado' => false])->one();
if($documentos)
    $modificaciones = ModificacionesActas::find()->where('contratista_id = :contratista and documento_registrado_id = :documento_registrado_id', ['contratista'=>Yii::$app->user->identity->contratista_id, 'documento_registrado_id'=> $documentos->id])->one();
}
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
                        ['label' => 'Cajas', 'url' => ['/nombres-cajas/index']],
                        ['label' => 'Notas revelatorias', 'url' => ['/notas-revelatorias/index']],
                        ['label' => 'A - Efectivos y sus equivalentes', 'url' => ['/a-efectivos-bancos/efectivosequivalentes']],
                        ['label' => 'AA - Obligaciones Bancarias', 'url' => ['/aa-obligaciones-bancarias/index']],
                        ['label' => 'E - Inversiones', 'url' => ['cuentas-e-inversiones/index']],
                        ['label' => 'C - Inventarios', 'url' => ['/cuentas-c-inventarios/inventarios']],
                        ['label' => 'HH - Pasivo laboral', 'url' => ['/cuentas-hh-pasivo-laboral/pasivolaboral']],
                        ['label' => 'JJ - Provisiones', 'url' => ['/cuentas-jj-proviciones/index']],
                        ['label' => 'DD-3 - Otros tributos por pagar', 'url' => ['/cuentas-dd3-otros-tributos/index']],
                        ['label' => 'II-1 - Gastos operacionales', 'url' => ['cuentas-ii1-gastos-operacionales/index']],
                        ['label' => 'I-2.1 - Declaración de IVA', 'url' => ['cuentas-i2-declaracion-iva/index']],
                        ['label' => 'I-2.2 - Declaración de ISLR', 'url' => ['cuentas-i2-declaracion-islr/index']],
                        ['label' => 'D-1 - Impuesto sobre la renta pagado por anticipado', 'url' => ['cuentas-d1-islr-pagado-anticipo/index']],
                        ['label' => 'D-2 - Otros tributos pagados', 'url' => ['cuentas-d2-otros-tributos-pag/index']],
                        ['label' => 'BB-3 - Otras cuentas por pagar', 'url' => ['cuentas-bb2-otras-cuentas-por-pagar/index']],
                        ['label' => 'BB-1 Cuentas por pagar comerciales', 'url' => ['cuenatas-bb1-cuentas-por-pagar-comerciales/index']],
                        ['label' => 'B-1 - Cuentas por cobrar comerciales', 'url' => ['cuentas-b1-cuentas-por-cobrar-comerciales/index']],
                        ['label' => 'B-2.1 - Otras cuentas por cobrar', 'url' => ['cuentas-b2-otras-cuentas-por-cobrar/index']],
                        ['label' => 'B-2.2 - Cuentas por cobrar comerciales', 'url' => ['cuentas-b2-otras-cuentas-por-cobrar-e/index']],
                        ['label' => 'I-4 - Costos personal', 'url' => ['cuentas-i4-costos-personal/index']],
                        ['label' => 'II-2 - Gastos personal', 'url' => ['cuentas-ii2-gastos-personal/index']],
                        ['label' => 'II-3 - Gastos funcionamiento', 'url' => ['cuentas-ii3-gastos-funcionamiento/index']],
                        ['label' => 'II-5 - Tributos', 'url' => ['cuentas-ii5-tributos/index']],



                    ],
                ],
                ['label' => 'Activos',
                    'items' => [
                         //['label' => 'Crear bien', 'url' => ['/activos-bienes/index']],
                        ['label' => 'Bienes', 'url' => ['/activos-bienes/index']],
                        ['label' => 'Avaluos', 'url' => ['/activos-avaluos/index']],
                        ['label' => 'Desincorporación', 'url' => ['/activos-desincorporacion-activos/index']],
                        ['label' => 'Mejoras propiedades', 'url' => ['/activos-mejoras-propiedades/index']],

                        ['label' => 'Bienes Muebles', 'url' => ['/activos-muebles/index']],
                        ['label' => 'Bienes Inmuebles', 'url' => ['/activos-inmuebles/index']],
                        ['label' => 'Construcciones Inmuebles', 'url' => ['/activos-construcciones-inmuebles/index']],
                        ['label' => 'Fabricaciones Muebles', 'url' => ['/activos-fabricaciones-muebles/index']],
                        ['label' => 'Bienes Biológicos', 'url' => ['/activos-activos-biologicos/index']],
                        ['label' => 'Bienes Intangibles', 'url' => ['/activos-activos-intangibles/index']],


                        //['label' => 'Datos', 'url' => ['/activos-avaluos/index']],
                        //['label' => 'Aqui van los otros', 'url' => ['#']],
                    ],
                ],
/*                ['label' => 'Información general',
                    'items' => [
                         ['label' => 'Aqui van las cosas', 'url' => ['#']],
                    ],
                ],*/
                ['label' => 'Contratista',
                    'items' => [
                         //['label' => 'Acordeon', 'url' => ['/contratistas/acordeon']],
                         
                         
                        ['label' => 'Bancos', 'url' => ['/bancos-contratistas/index']],
                        ['label' => 'Persona de contacto', 'url' => ['/contratistas-contactos/index']],
                        ['label' => 'Objeto empresa', 'url' => ['/objetos-empresas/index']],
                        ['label' => 'Principio contable', 'url' => ['/principios-contables/index']],
                       /*  ['label' => 'Responsable Contabilidad', 'url' => ['/comisarios-auditores/crearresponsable']],
                         ['label' => 'Contador Auditor', 'url' => ['/comisarios-auditores/crearcontador']],
                         ['label' => 'Profesional Informe de conversion', 'url' => ['/comisarios-auditores/crearprofesional']],*/
                         ['label' => 'Relacion de Contratos', 'url' => ['/relaciones-contratos/index']],
                         ['label' => 'Empresas Relacionadas', 'url' => ['/empresas-relacionadas/index']],
                         ['label' => 'Polizas Contratadas', 'url' => ['/polizas-contratadas/index']],
                         ['label' => 'Certificacion Aportes', 'url' => ['/certificaciones-aportes/index']],
                         ['label' => 'Responsable Contabilidad Interna', 'url' => ['/comisarios-auditores/responsable']],
                         ['label' => 'Contador Auditor', 'url' => ['/comisarios-auditores/auditor']],
                         ['label' => 'Profesional Informe de Conversion', 'url' => ['/comisarios-auditores/profesional']],
         
                        
                    ],
                ],
                 ['label' => 'Acta Constitutiva',
                    'items' => [
                        ['label' => 'Resumen Acta Constitutiva', 'url' => ['/actas-constitutivas/resumenacta']],
                        ['label' => '1. Registro Documento', 'url' => ['/activos-documentos-registrados/index']],
                        ['label' => '2. Razon Social', 'url' => ['/razones-sociales/index']],
                        ['label' => '3. Objeto Social', 'url' => ['/objetos-sociales/index']],
                        ['label' => '4. Cierre ejercicio Econonomico', 'url' => ['/cierres-ejercicios/index']],
                        ['label' => '5. Duracion empresa', 'url' => ['/duraciones-empresas/index']],
                        ['label' => '6. Actividades Economicas', 'url' => ['/actividades-economicas/index']],
                        ['label' => '7. Direcciones', 'url' => ['/domicilios/index']],
                        ['label' => '8. Denominaciones Comerciales', 'url' => ['/denominaciones-comerciales/index']],
                        ['label' => '9. Capital', 'url' => ['/actas-constitutivas/crearcapitalsuscrito']],
                        ['label' => '10. Origen Capital', 'url' => ['/origenes-capitales/index']],
                        ['label' => '11. Accionistas Representante Legal o Junta Directiva', 'url' => ['/accionistas-otros/index']],
                        ['label' => '12. Comisarios', 'url' => ['/comisarios-auditores/index']],
                        ['label' => '13. Fondos Reservas', 'url' => ['/fondos-reservas/index']],
                        ['label' => '14. Sucursales', 'url' => ['/sucursales/index']],
                    ],
                ],
            ];

            if($acta)
            {
             $menuItems[] = ['label' => 'Modificacion acta',
                    'items' => [
                         ['label' => 'Resumen Modificacion', 'url' => ['/actas-constitutivas/resumenmodificacion']],
                        ['label' => 'Registro documento modificado', 'url' => ['/activos-documentos-registrados/modificacion']],
                        ['label' => 'Modificaciones', 'url' => ['/modificaciones-actas/index'], 'visible' => ($documentos) ? true : false],
                        ['label' => 'Cambio Nombre o Razon Social', 'url' => ['razones-sociales/modificacion'], 'visible' => ($modificaciones) ? $modificaciones->razon_social : false],
                        ['label' => 'Cambio Objeto Social', 'url' => ['objetos-sociales/modificacion'], 'visible' => ($modificaciones) ? $modificaciones->objeto_social : false],
                        ['label' => 'Cambio Domicilio', 'url' => ['domicilios/modificacion'], 'visible' => ($modificaciones) ? $modificaciones->domicilio_fiscal : false],
                        ['label' => 'Cambio de Denominacion Comercial', 'url' => ['/denominaciones-comerciales/modificacion'], 'visible' => ($modificaciones) ? $modificaciones->denominacion_comercial : false],
                        ['label' => 'Cambio Cierre Ejercicio Econonomico', 'url' => ['/cierres-ejercicios/modificacion'], 'visible' => ($modificaciones) ? $modificaciones->cierre_ejercicio: false],
                        ['label' => 'Duracion empresa', 'url' => ['/duraciones-empresas/modificacion'], 'visible' => ($modificaciones) ? $modificaciones->duracion_empresa : false],
                        ['label' => 'Pago Capital', 'url' => ['/actas-constitutivas/crearpagocapital'], 'visible' => ($modificaciones) ? $modificaciones->pago_capital : false],
                        ['label' => 'Aumento Capital', 'url' => ['/actas-constitutivas/crearaumentocapital'], 'visible' => ($modificaciones) ? $modificaciones->aumento_capital : false],
                        ['label' => 'Disminucion Capital', 'url' => ['/actas-constitutivas/creardisminucion'], 'visible' => ($modificaciones) ? $modificaciones->disminucion_capital : false],
                        ['label' => 'Aporte por Capitalizar', 'url' => ['/aportes-capitalizar/index'], 'visible' => ($modificaciones) ? $modificaciones->aporte_capitalizar : false],
                        ['label' => 'Venta de Acciones', 'url' => ['/actas-constitutivas/crearventa'], 'visible' => ($modificaciones) ? $modificaciones->venta_accion : false],
                        ['label' => 'Correcion Monetaria', 'url' => ['/correcciones-monetarias/index'], 'visible' => ($modificaciones) ? $modificaciones->coreccion_monetaria : false],
                        ['label' => 'Limitacion de Capital', 'url' => ['/limitaciones-capitales/index'], 'visible' => ($modificaciones) ? $modificaciones->limitacion_capital || $modificaciones->limitacion_capital_afectado: false],
                        ['label' => 'Reintegro de Perdidas', 'url' => ['/limitaciones-capitales/index'], 'visible' => ($modificaciones) ? $modificaciones->reintegro_perdida : false],
                        ['label' => 'Fondo de Emergencia', 'url' => ['/fondos-emergencias/index'], 'visible' => ($modificaciones) ? $modificaciones->fondo_emergencia : false],
                        ['label' => 'Decreto de Dividendos en Efectivo ', 'url' => ['/decretos-div-excedentes/index'], 'visible' => ($modificaciones) ? $modificaciones->decreto_div_excedente : false],
                        ['label' => 'Discusión y Aprobación o Modificación de Balances', 'url' => ['/modificaciones-balances/index'], 'visible' => ($modificaciones) ? $modificaciones->modificacion_balance : false],
                        ['label' => 'Nombramiento del Representante Legal', 'url' => ['/accionistas-otros/representante'], 'visible' => ($modificaciones) ? $modificaciones->representante_legal : false],
                        ['label' => 'Actualizacion de Junta Directiva', 'url' => ['/accionistas-otros/junta'], 'visible' => ($modificaciones) ? $modificaciones->junta_directiva : false],
                        ['label' => 'Designacion del comisario', 'url' => ['/comisarios-auditores/comisario'], 'visible' => ($modificaciones) ? $modificaciones->comisario : false],
                        ['label' => 'Origen Capital', 'url' => ['/origenes-capitales/origen'], 'visible' => ($modificaciones) ? $modificaciones->aumento_capital || $modificaciones->pago_capital || $modificaciones->aporte_capitalizar: false],
                    ],
                ];
                
                
            }

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
                            ['label'=>'Añadir correo', 'url'=>['/user-management/auth/confirm-email']],
                            ['label' => 'Datos basicos', 'url' => ['/contratistas/index']],
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
        <?= Alert::widget()?>
        <?php

        use kartik\tabs\TabsX;
        $item = [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Corrientes',
                'content'=> 'A', // Para colocar todos los links a cada cuenta dependiendo de esta sección.
                'active'=>true,
                //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/aa-obligaciones-bancarias/tabs-data'])]
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list"></i> No corrientes',
                'content'=>'',
                //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/tabs-data'])]
            ],

        ];

        $items = [
            [
                'label'=>'<i class="glyphicon glyphicon-list"></i> Cuentas Activos',
                'content'=>TabsX::widget([
                    'items'=>$item,
                    'position'=>TabsX::POS_ABOVE,
                    'bordered'=>false,
                    'encodeLabels'=>false
                ]),
                'active'=>true
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list"></i> Cuentas Pasivos',
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
        /*echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
            'options' => ['class' =>'nav-tabs '],
        ]);*/

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

