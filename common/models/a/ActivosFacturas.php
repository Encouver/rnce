<?php

namespace common\models\a;

use common\models\p\PersonasJuridicas;
use common\models\p\SysNaturalesJuridicas;
use kartik\builder\Form;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;

/**
 * This is the model class for table "activos.facturas".
 *
 * @property integer $id
 * @property string $num_factura
 * @property integer $proveedor_id
 * @property string $fecha_emision
 * @property integer $imprenta_id
 * @property string $fecha_emision_talonario
 * @property integer $comprador_id
 * @property string $base_imponible_gravable
 * @property string $exento
 * @property string $iva
 * @property integer $contratista_id
 * @property integer $bien_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 * @property PersonasJuridicas $proveedor
 * @property PersonasJuridicas $imprenta
 * @property PersonasJuridicas $contratista
 * @property SysNaturalesJuridicas $comprador
 */
class ActivosFacturas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.facturas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_factura', 'proveedor_id', 'fecha_emision', 'imprenta_id', 'fecha_emision_talonario', 'comprador_id', 'base_imponible_gravable', 'iva', 'contratista_id', 'bien_id'], 'required'],
            [['proveedor_id', 'imprenta_id', 'comprador_id', 'contratista_id', 'bien_id'], 'integer'],
            [['fecha_emision', 'fecha_emision_talonario', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['base_imponible_gravable', 'exento', 'iva'], 'number'],
            [['sys_status'], 'boolean'],
            [['num_factura'], 'string', 'max' => 255],
            [['proveedor_id', 'num_factura'], 'unique', 'targetAttribute' => ['proveedor_id', 'num_factura'], 'message' => 'The combination of Num Factura and Proveedor ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'num_factura' => Yii::t('app', 'Num Factura'),
            'proveedor_id' => Yii::t('app', 'Proveedor ID'),
            'fecha_emision' => Yii::t('app', 'Fecha Emision'),
            'imprenta_id' => Yii::t('app', 'Imprenta ID'),
            'fecha_emision_talonario' => Yii::t('app', 'Fecha Emision Talonario'),
            'comprador_id' => Yii::t('app', 'Comprador ID'),
            'base_imponible_gravable' => Yii::t('app', 'Base Imponible Gravable'),
            'exento' => Yii::t('app', 'Exento'),
            'iva' => Yii::t('app', 'Iva'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
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
    public function getProveedor()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'proveedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImprenta()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'imprenta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprador()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'comprador_id']);
    }


    public function getFormAttribs() {
        $attributes = [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'num_factura'=>['type'=>Form::INPUT_TEXT,],
            'fecha_emision'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>true]
            ],
            'proveedor_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'rif',function($model){return $model->etiqueta(); }),'options'=>[]]],
            'imprenta_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'rif',function($model){return $model->etiqueta(); }),'options'=>[]]],
            'fecha_emision_talonario'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>true]
            ],
            'comprador_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(SysNaturalesJuridicas::find()->all(),'id','nombre',function($model){ return $model->sysClasificacionBien->nombre;}),'options'=>[]]],
            'base_imponible_gravable'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'exento'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'iva'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],


            'origen_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysOrigenesBienes::find()->asArray()->all(),'id','nombre'),'options'=>['id'=>'origen','onchange'=>'js: this.form.submit();'/*'js: $("#nacional").hide(true); $("#nacional").hide(); if($("#origen").attr()==1 || $("#origen").attr()==3)$("#fecha_origen").show(); if($("#origen").attr()==2)$("#nacional").show();'*/]]],
            'propio'=>['type'=>Form::INPUT_CHECKBOX,],
            'factura'=>['type'=>Form::INPUT_CHECKBOX,],
            'documento'=>['type'=>Form::INPUT_CHECKBOX,],
            //'principio_contable_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysFormasOrg::find()->asArray()->all(),'id','nombre')]],
            /*'fecha_origen'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>true]
            ],*/
            //'nacional'=>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true]],
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],

        ];


        return $attributes;
    }
}
