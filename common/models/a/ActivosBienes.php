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
 * @property string $origen
 * @property string $fecha_origen
 * @property integer $contratista_id
 * @property boolean $propio
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosActivosBiologicos[] $activosActivosBiologicos
 * @property ActivosActivosIntangibles[] $activosActivosIntangibles
 * @property ActivosAvaluos[] $activosAvaluos
 * @property ActivosSysFormasOrg $principioContable
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
            [['sys_tipo_bien_id', 'principio_contable', 'origen', 'fecha_origen', 'contratista_id'], 'required'],
            [['sys_tipo_bien_id', 'principio_contable', 'contratista_id'], 'integer'],
            [['depreciable', 'deterioro', 'propio', 'sys_status'], 'boolean'],
            [['fecha_origen', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['detalle', 'origen'], 'string', 'max' => 255]
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
            'origen' => Yii::t('app', 'Origen'),
            'fecha_origen' => Yii::t('app', 'Fecha Origen'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'propio' => Yii::t('app', 'Propio'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosActivosBiologicos()
    {
        return $this->hasMany(ActivosActivosBiologicos::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosActivosIntangibles()
    {
        return $this->hasMany(ActivosActivosIntangibles::className(), ['bien_id' => 'id']);
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
        return $this->hasMany(ActivosConstruccionesInmuebles::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosDatosImportaciones()
    {
        return $this->hasMany(ActivosDatosImportaciones::className(), ['bien_id' => 'id']);
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
        return $this->hasMany(ActivosFabricacionesMuebles::className(), ['bien_id' => 'id']);
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
        return $this->hasMany(ActivosInmuebles::className(), ['bien_id' => 'id']);
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
        return $this->hasMany(ActivosMuebles::className(), ['bien_id' => 'id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'sys_tipo_bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposBienes::find()->asArray()->all(),'id','nombre',function($model){ return ActivosSysTiposBienes::findOne($model['sys_clasificacion_bien_id'])->sysClasificacionBien->nombre;}),'options'=>['onchange'=>'js:this.form.submit();']]],

            'depreciable'=>['type'=>Form::INPUT_CHECKBOX,],
            'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],
            'detalle'=>['type'=>Form::INPUT_TEXT,],
            'origen'=>['type'=>Form::INPUT_TEXT,],
            'propio'=>['type'=>Form::INPUT_CHECKBOX,],
            'principio_contable'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(ActivosSysFormasOrg::find()->asArray()->all(),'id','nombre'),],
            'fecha_origen'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],

        ];
    }
}
