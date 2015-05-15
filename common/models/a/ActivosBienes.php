<?php

namespace common\models\a;

use common\models\p\Contratistas;
use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activos.bienes".
 *
 * @property integer $id
 * @property integer $sys_tipo_bien_id
 * @property integer $principio_contable
 * @property boolean $depreciable
 * @property boolean $deterioro
 * @property string $detalle
 * @property string $fecha_origen
 * @property integer $contratista_id
 * @property boolean $propio
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $origen_id
 * @property boolean $nacional
 *
 * @property ActivosActivosBiologicos[] $activosActivosBiologicos
 * @property ActivosActivosIntangibles[] $activosActivosIntangibles
 * @property ActivosAvaluos[] $activosAvaluos
 * @property ActivosSysFormasOrg $principioContable
 * @property ActivosSysOrigenesBienes $origen
 * @property ActivosSysTiposBienes $sysTipoBien
 * @property Contratistas $contratista
 * @property ActivosConstruccionesInmuebles[] $activosConstruccionesInmuebles
 * @property ActivosDatosImportaciones[] $activosDatosImportaciones
 * @property ActivosDepreciacionesAmortizaciones[] $activosDepreciacionesAmortizaciones
 * @property ActivosDeterioros[] $activosDeterioros
 * @property ActivosFabricacionesMuebles[] $activosFabricacionesMuebles
 * @property ActivosFacturas[] $activosFacturas
 * @property ActivosInmuebles[] $activosInmuebles
 * @property ActivosMediciones[] $activosMediciones
 * @property ActivosMejorasPropiedades[] $activosMejorasPropiedades
 * @property ActivosMuebles[] $activosMuebles
 */
class ActivosBienes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.bienes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_tipo_bien_id', 'principio_contable', 'contratista_id', 'origen_id'], 'required'],
            [['sys_tipo_bien_id', 'principio_contable', 'contratista_id', 'origen_id'], 'integer'],
            [['depreciable', 'deterioro', 'propio', 'sys_status', 'nacional'], 'boolean'],
            [['fecha_origen', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['detalle'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_tipo_bien_id' => Yii::t('app', 'Tipo de Bien'),
            'principio_contable' => Yii::t('app', 'Principio Contable'),
            'depreciable' => Yii::t('app', 'Depreciable'),
            'deterioro' => Yii::t('app', 'Deterioro'),
            'detalle' => Yii::t('app', 'Detalle'),
            'fecha_origen' => Yii::t('app', 'Fecha Origen'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'propio' => Yii::t('app', 'Propio'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'origen_id' => Yii::t('app', 'Origen'),
            'nacional' => Yii::t('app', 'Nacional'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosActivosBiologicos()
    {
        return $this->hasOne(ActivosActivosBiologicos::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosActivosIntangibles()
    {
        return $this->hasOne(ActivosActivosIntangibles::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosAvaluos()
    {
        return $this->hasMany(ActivosAvaluos::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigen()
    {
        return $this->hasOne(ActivosSysOrigenesBienes::className(), ['id' => 'origen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrincipioContable()
    {
        return $this->hasOne(ActivosSysFormasOrg::className(), ['id' => 'principio_contable']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysTipoBien()
    {
        return $this->hasOne(ActivosSysTiposBienes::className(), ['id' => 'sys_tipo_bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosConstruccionesInmuebles()
    {
        return $this->hasOne(ActivosConstruccionesInmuebles::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosDatosImportaciones()
    {
        return $this->hasOne(ActivosDatosImportaciones::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosDepreciacionesAmortizaciones()
    {
        return $this->hasMany(ActivosDepreciacionesAmortizaciones::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosDeterioros()
    {
        return $this->hasMany(ActivosDeterioros::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosFabricacionesMuebles()
    {
        return $this->hasOne(ActivosFabricacionesMuebles::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosFacturas()
    {
        return $this->hasMany(ActivosFacturas::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosInmuebles()
    {
        return $this->hasOne(ActivosInmuebles::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosMediciones()
    {
        return $this->hasMany(ActivosMediciones::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosMejorasPropiedades()
    {
        return $this->hasMany(ActivosMejorasPropiedades::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosMuebles()
    {
        return $this->hasOne(ActivosMuebles::className(), ['bien_id' => 'id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'sys_tipo_bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposBienes::find()->all(),'id','nombre',function($model){ return $model->sysClasificacionBien->nombre;}),'options'=>['onchange'=>'js:this.form.submit();']]],

            'depreciable'=>['type'=>Form::INPUT_CHECKBOX,],
            'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],
            'detalle'=>['type'=>Form::INPUT_TEXT,],
            'origen_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysOrigenesBienes::find()->asArray()->all(),'id','nombre'),'options'=>['id'=>'origen','onchange'=>'js: $("#nacional").hide(true); $("#nacional").hide(); if($("#origen").attr()==1 || $("#origen").attr()==3)$("#fecha_origen").show(); if($("#origen").attr()==2)$("#nacional").show();']]],
            'propio'=>['type'=>Form::INPUT_CHECKBOX,],
            'principio_contable'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(ActivosSysFormasOrg::find()->asArray()->all(),'id','nombre'),],
            'fecha_origen'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>true]
            ],
            'nacional'=>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true]],
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],

        ];
    }

    public function getBienTipo()
    {
        if($this->activosInmuebles!=null)
            return $this->activosInmuebles;
        if($this->activosMuebles!=null)
            return $this->activosMuebless;
        if($this->activosConstruccionesInmuebles!=null)
            return $this->activosConstruccionesInmuebles;
        if($this->activosFabricacionesMuebles!=null)
            return $this->activosFabricacionesMuebles;
        if($this->activosActivosBiologicos!=null)
            return $this->activosActivosBiologicos;
        if($this->activosActivosIntangibles!=null)
            return $this->activosActivosIntangibles;

        return null;
    }
}
