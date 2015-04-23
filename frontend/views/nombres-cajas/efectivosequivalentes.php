<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\p\NombresCajas */

$this->title = Yii::t('app', 'Efectivos y sus equivalentes');

$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-home"></i> Home',
        'content'=>"",
        'active'=>true
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Profile',
        'content'=>$content2,
        'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/nombres-cajas/create'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
        'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>$content3,
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>$content4,
             ],
        ],
    ],
];

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    'encodeLabels'=>false
]);

?>

