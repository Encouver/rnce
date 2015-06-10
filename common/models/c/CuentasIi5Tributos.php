<?php

namespace common\models\c;

use common\models\a\ActivosSysMetodosMedicion;
use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuentas.ii5_tributos".
 *
 * @property integer $id
 * @property integer $concepto_id
 * @property string $administracion
 * @property integer $admin_metodo_id
 * @property string $administracion_ajustada
 * @property string $ventas
 * @property integer $ventas_metodo_id
 * @property string $ventas_ajustadas
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosSysMetodosMedicion $adminMetodo
 * @property ActivosSysMetodosMedicion $ventasMetodo
 * @property CuentasSysConceptos $concepto
 * @property Contratistas $contratista
 */
class CuentasIi5Tributos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.ii5_tributos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['concepto_id', 'administracion', 'admin_metodo_id', 'administracion_ajustada', 'contratista_id', 'anho'], 'required'],
            [['concepto_id', 'admin_metodo_id', 'ventas_metodo_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['administracion', 'administracion_ajustada', 'ventas', 'ventas_ajustadas'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100],
            [['concepto_id', 'contratista_id', 'anho'], 'unique', 'targetAttribute' => ['concepto_id', 'contratista_id', 'anho'], 'message' => 'Este concepto ya fue cargado.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'concepto_id' => Yii::t('app', 'Concepto'),
            'administracion' => Yii::t('app', 'Administracion'),
            'admin_metodo_id' => Yii::t('app', 'Admin Metodo ID'),
            'administracion_ajustada' => Yii::t('app', 'Administracion Ajustada'),
            'ventas' => Yii::t('app', 'Ventas'),
            'ventas_metodo_id' => Yii::t('app', 'Ventas Metodo ID'),
            'ventas_ajustadas' => Yii::t('app', 'Ventas Ajustadas'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminMetodo()
    {
        return $this->hasOne(ActivosSysMetodosMedicion::className(), ['id' => 'admin_metodo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentasMetodo()
    {
        return $this->hasOne(ActivosSysMetodosMedicion::className(), ['id' => 'ventas_metodo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'concepto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],

            'concepto_id' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(CuentasSysConceptos::concepto('i5'),'id','nombre',function($model){ return $model->sysClasificacion->nombre;}),
                'options'=>['id'=>'declaración-islr-concepto','placeholder'=>'Seleccionar ', 'onchange'=>''],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'administracion' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'admin_metodo_id' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysMetodosMedicion::metodos(),'id','nombre',function($model){ return $model->modelo->nombre;}),
                'options'=>['id'=>'declaración-islr-concepto','placeholder'=>'Seleccionar ', 'onchange'=>''],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'ventas' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'ventas_metodo_id' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysMetodosMedicion::metodos(),'id','nombre',function($model){ return $model->modelo->nombre;}),
                'options'=>['id'=>'declaración-islr-concepto','placeholder'=>'Seleccionar ', 'onchange'=>''],'pluginOptions' => [
                    'allowClear' => false,
                ],]],

        ];
    }
}
