<?php

namespace common\models\a;

use common\models\p\Contratistas;
use common\models\p\PrincipiosContables;
use kartik\builder\Form;
use kartik\checkbox\CheckboxX;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * This is the model class for table "activos.bienes".
 *
 * @property integer $id
 * @property integer $sys_tipo_bien_id
 * @property string $detalle
 * @property string $fecha_origen
 * @property integer $contratista_id
 * @property boolean $propio
 * @property integer $origen_id
 * @property boolean $nacional
 * @property integer $factura_id
 * @property integer $documento_registrado_id
 * @property integer $arrendamiento_id
 * @property integer $desincorporacion_id
 * @property boolean $mejora
 * @property boolean $perdida_reverso
 * @property boolean $proc_productivo
 * @property boolean $directo
 * @property boolean $proc_ventas
 * @property integer $metodo_medicion_id
 * @property boolean $carga_completa
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosActivosBiologicos $activosActivosBiologicos
 * @property ActivosActivosIntangibles $activosActivosIntangibles
 * @property ActivosAvaluos[] $activosAvaluos
 * @property ActivosArrendamientos $arrendamiento
 * @property ActivosDesincorporacionActivos $desincorporacion
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property ActivosFacturas $factura
 * @property ActivosSysMetodosMedicion $metodoMedicion
 * @property ActivosSysOrigenesBienes $origen
 * @property ActivosSysTiposBienes $sysTipoBien
 * @property Contratistas $contratista
 * @property ActivosConstruccionesInmuebles $activosConstruccionesInmuebles
 * @property ActivosDatosImportaciones $activosDatosImportaciones
 * @property ActivosDepreciacionesAmortizaciones[] $activosDepreciacionesAmortizaciones
 * @property ActivosDeterioros[] $activosDeterioros
 * @property ActivosFabricacionesMuebles $activosFabricacionesMuebles
 * @property ActivosInmuebles $activosInmuebles
 * @property ActivosMediciones[] $activosMediciones
 * @property ActivosMejorasPropiedades[] $activosMejorasPropiedades
 * @property ActivosMejorasPropiedades[] $activosMejorasPropiedades0
 * @property ActivosMuebles $activosMuebles
 * @property OrigenesCapitales[] $origenesCapitales
 */
class ActivosBienes extends \common\components\BaseActiveRecord
{
    public $factura;
    public $documento;

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

            [['sys_tipo_bien_id', 'contratista_id', 'origen_id', 'detalle'], 'required'],
            [['sys_tipo_bien_id', 'contratista_id', 'origen_id', 'creado_por', 'actualizado_por', 'factura_id', 'documento_registrado_id', 'arrendamiento_id', 'desincorporacion_id', 'metodo_medicion_id'], 'integer'],
            [['arrendamiento_id'], 'required', 'when'=> function ($model) {
                return !$model->propio;
                    }, 'whenClient' => "function (attribute, value) {
                return !$('#propio').is(':checked');
            }"],
            [['fecha_origen', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['propio', 'nacional', 'carga_completa', 'sys_status','documento','factura', 'mejora', 'perdida_reverso', 'proc_productivo', 'directo', 'proc_ventas'], 'boolean'],
            [['detalle'], 'string', 'max' => 255],
            [['sys_tipo_bien_id', 'detalle', 'contratista_id'], 'unique', 'targetAttribute' => ['sys_tipo_bien_id', 'detalle', 'contratista_id'], 'message' => 'El nombre de detalle debe ser único para entre todos sus bienes.']
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
            'detalle' => Yii::t('app', 'Detalle'),
            'fecha_origen' => Yii::t('app', 'Fecha Origen'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'propio' => Yii::t('app', 'Propio'),
            'origen_id' => Yii::t('app', 'Origen'),
            'nacional' => Yii::t('app', 'Nacional'),
            'factura_id' => Yii::t('app', 'Factura'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'arrendamiento_id' => Yii::t('app', 'Arrendamiento'),
            'desincorporacion_id' => Yii::t('app', 'Desincorporacion'),
            'mejora' => Yii::t('app', 'Mejora'),
            'perdida_reverso' => Yii::t('app', 'Perdida Reverso'),
            'proc_productivo' => Yii::t('app', 'Proceso Productivo'),
            'directo' => Yii::t('app', 'Directo'),
            'proc_ventas' => Yii::t('app', 'Proceso Ventas'),
            'metodo_medicion_id' => Yii::t('app', 'Metodo Medicion'),
            'carga_completa' => Yii::t('app', 'Carga Completa'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }
    /**
     * @return boolean
     */
    public function getPrincipioContable()
    {
        return $this->hasOne(PrincipiosContables::className(), ['contratista_id' => 'contratista_id']);
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
    public function getArrendamiento()
    {
        return $this->hasOne(ActivosArrendamientos::className(), ['id' => 'arrendamiento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesincorporacion()
    {
        return $this->hasOne(ActivosDesincorporacionActivos::className(), ['id' => 'desincorporacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoMedicion()
    {
        return $this->hasOne(ActivosSysMetodosMedicion::className(), ['id' => 'metodo_medicion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(ActivosFacturas::className(), ['id' => 'factura_id']);
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
    public function getSysTipoBien()
    {
        return $this->hasOne(ActivosSysTiposBienes::className(), ['id' => 'sys_tipo_bien_id']);
    }

    /**
     * @return boolean
     */
    public function Deterioro()
    {
        return $this->sysTipoBien->deterioro;
    }
    /**
     * @return boolean
     */
    public function Depreciacion()
    {
        return $this->sysTipoBien->depreciacion;
    }

    /**
     * @return string
     */
    public function principioContable()
    {
        return PrincipiosContables::findOne(['contratista_id'=>'contratista_id'])->principio_contable;
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
    public function getActivosMejorasPropiedades0()
    {
        return $this->hasMany(ActivosMejorasPropiedades::className(), ['mejora_bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosMuebles()
    {
        return $this->hasOne(ActivosMuebles::className(), ['bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigenesCapitales()
    {
        return $this->hasMany(OrigenesCapitales::className(), ['bien_id' => 'id']);
    }

    public function getFormAttribs() {
         $attributes = [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'sys_tipo_bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposBienes::find()->all(),'id','nombre',function($model){ return $model->sysClasificacionBien->nombre;}),'options'=>['onchange'=>'js:this.form.submit();']]],

            //'depreciable'=>['type'=>Form::INPUT_CHECKBOX,],
            //'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],
            'detalle'=>['type'=>Form::INPUT_TEXT,],
            'origen_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysOrigenesBienes::find()->asArray()->all(),'id','nombre'),'options'=>['id'=>'origen','onchange'=>'js:']]],

             'factura_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                 'options'=>['id'=>'factura','placeholder'=>'Seleccionar factura', 'onchange'=>'js:'],'pluginOptions' => [
                     'allowClear' => true,
                     'minimumInputLength' => 1,
                     'ajax' => [
                         'url' => \yii\helpers\Url::to(['activos-facturas/facturas-lista']),
                         'dataType' => 'json',
                         'data' => new JsExpression('function(params) { return {q:params.term}; }')
                     ],
                     'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                     'templateResult' => new JsExpression('function(city) { return city.text; }'),
                     'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                 ],]],

             'documento_registrado_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                 'options'=>['id'=>'documento-registrado','placeholder'=>'Seleccionar documento registrado', 'onchange'=>'js:'],'pluginOptions' => [
                     'allowClear' => true,
                     'minimumInputLength' => 1,
                     'ajax' => [
                         'url' => \yii\helpers\Url::to(['activos-documentos-registrados/documentos-registrados-lista']),
                         'dataType' => 'json',
                         'data' => new JsExpression('function(params) { return {q:params.term}; }')
                     ],
                     'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                     'templateResult' => new JsExpression('function(city) { return city.text; }'),
                     'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                 ],]],
            'propio'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],
            //'factura'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],
             //'documento'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],

             'metodo_medicion_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysMetodosMedicion::find()->all(),'id','nombre',function($model){ return $model->modelo->nombre;}), 'pluginOptions'=>['allowClear' => true],'options'=>['id'=>'metodo-medicion','placeholder'=>'Seleccionar método de medición', 'onchange'=>'js:']]],
             // Mejora
             'mejora'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],
             'perdida_reverso'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],

             'proc_productivo'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],
             // Si proc_productivo es true
             'directo'=>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true,]],
             // Si proceso productivo es false.
             'proc_ventas'=>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>false,]],


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

        //if($this->origen_id==1 or $this->origen_id ==4)
        $attributes['fecha_origen'] = ['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'label'=>$this->origen_id==1?'Fecha de la Asamblea':'Fecha de incorporacion en el inventario de activos','options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
            'convertFormat' => true,

            'pluginOptions' => [
                'format' => 'd-M-yyyy ',
                //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                'todayHighlight' => true
            ]],
            'columnOptions'=>[ 'hidden'=>false,]
        ];
        //if($this->origen_id==2)
            $attributes['nacional'] = ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true,],'options'=>['onchange'=>'']];

        return $attributes;
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

    public function Etiqueta(){
        return $this->sysTipoBien->nombre.' - '.$this->detalle;
    }
}
