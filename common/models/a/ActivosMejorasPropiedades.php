<?php

namespace common\models\a;

use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activos.mejoras_propiedades".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $monto
 * @property string $fecha
 * @property boolean $capitalizable
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $mejora_bien_id
 * @property string $descripcion
 *
 * @property ActivosBienes $bien
 * @property ActivosBienes $mejoraBien
 */
class ActivosMejorasPropiedades extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.mejoras_propiedades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'monto', 'fecha', 'mejora_bien_id', 'descripcion', 'capitalizable'], 'required',
                'when' => function ($model) {
                return !$model->bien->mejora;
            }, 'whenClient' => "function (attribute, value) {
                    return $('#activosbienes-mejora').is(':checked');
                }"],
            [['bien_id', 'creado_por', 'actualizado_por', 'mejora_bien_id'], 'integer'],
            [['monto'], 'number'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['capitalizable', 'sys_status'], 'boolean'],
            [['descripcion'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien'),
            'monto' => Yii::t('app', 'Monto'),
            'fecha' => Yii::t('app', 'Fecha'),
            'capitalizable' => Yii::t('app', 'Capitalizable'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'mejora_bien_id' => Yii::t('app', 'Mejora Bien'),
            'descripcion' => Yii::t('app', 'Descripción'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMejoraBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'mejora_bien_id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'mejora_bien_id' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosBienes::find()->all(),'id',function($model){return  $model->etiqueta();}),
                'options'=>['id'=>'mejora-bien-id','placeholder'=>'Seleccionar motivo', 'onchange'=>'js:'],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'monto' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'fecha' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            'capitalizable' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>false,],'options'=>['onchange'=>'']],

            'descripcion' => ['type'=>Form::INPUT_TEXT,],


        ];
    }

}
