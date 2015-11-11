<?php

namespace common\models\p;

use kartik\builder\Form;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "public.contratistas".
 *
 * @property integer $id
 * @property integer $natural_juridica_id
 * @property integer $estatus_contratista_id
 * @property string $sigla
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_sector
 *
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property Capitales[] $capitales
 * @property AccionistasOtros[] $accionistasOtros
 * @property BancosContratistas[] $bancosContratistas
 * @property DuracionesEmpresas[] $duracionesEmpresas
 * @property CierresEjercicios[] $cierresEjercicios
 * @property ComisariosAuditores[] $comisariosAuditores
 * @property DenominacionesComerciales[] $denominacionesComerciales
 * @property Clientes[] $clientes
 * @property NombresCajas[] $nombresCajas
 * @property NotasRevelatorias[] $notasRevelatorias
 * @property Sucursales[] $sucursales
 * @property ObjetosSociales[] $objetosSociales
 * @property PolizasContratadas[] $polizasContratadas
 * @property RazonesSociales[] $razonesSociales
 * @property RelacionesContratos[] $relacionesContratos
 * @property Domicilios[] $domicilios
 * @property EstatusContratistas $estatusContratista
 * @property SysNaturalesJuridicas $naturalJuridica
 * @property PrincipiosContables[] $principiosContables
 * @property ActividadesEconomicas[] $actividadesEconomicas
 * @property ContratistasContactos[] $contratistasContactos
 */
class Contratistas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.contratistas';
    }

    /**
     * @inheritdoc
     */
   
    public function rules()
    {
        return [
            [['estatus_contratista_id'], 'required'],
            [['natural_juridica_id', 'estatus_contratista_id','creado_por','actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_sector'], 'string'],
            [['sigla'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica'),
            'estatus_contratista_id' => Yii::t('app', 'Estatus Contratista'),
            'sigla' => Yii::t('app', 'Sigla'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_sector' => Yii::t('app', 'Tipo Sector'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitales()
    {
        return $this->hasMany(Capitales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionistasOtros()
    {
        return $this->hasMany(AccionistasOtros::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancosContratistas()
    {
        return $this->hasMany(BancosContratistas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDuracionesEmpresas()
    {
        return $this->hasMany(DuracionesEmpresas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCierresEjercicios()
    {
        return $this->hasMany(CierresEjercicios::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComisariosAuditores()
    {
        return $this->hasMany(ComisariosAuditores::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDenominacionesComerciales()
    {
        return $this->hasMany(DenominacionesComerciales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombresCajas()
    {
        return $this->hasMany(NombresCajas::className(), ['contratistas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasRevelatorias()
    {
        return $this->hasMany(NotasRevelatorias::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursales()
    {
        return $this->hasMany(Sucursales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosSociales()
    {
        return $this->hasMany(ObjetosSociales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolizasContratadas()
    {
        return $this->hasMany(PolizasContratadas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazonesSociales()
    {
        return $this->hasMany(RazonesSociales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionesContratos()
    {
        return $this->hasMany(RelacionesContratos::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilios()
    {
        return $this->hasMany(Domicilios::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatusContratista()
    {
        return $this->hasOne(EstatusContratistas::className(), ['id' => 'estatus_contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaturalJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridica_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrincipiosContables()
    {
        return $this->hasMany(PrincipiosContables::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadesEconomicas()
    {
        return $this->hasMany(ActividadesEconomicas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratistasContactos()
    {
        return $this->hasMany(ContratistasContactos::className(), ['contratista_id' => 'id']);
    }

    public function getFormAttribs() {



/*
        $attributes = [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],


            'id' => Yii::t('app', 'ID'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica'),
            'estatus_contratista_id' => Yii::t('app', 'Estatus Contratista'),
            'sigla' => Yii::t('app', 'Sigla'),
            'tipo_sector' => Yii::t('app', 'Tipo Sector'),


            'sys_tipo_bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposBienes::find()->all(),'id','nombre',function($model){ return $model->sysClasificacionBien->nombre;}),'options'=>['onchange'=>'js:this.form.submit();']]],

            //'depreciable'=>['type'=>Form::INPUT_CHECKBOX,],
            //'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],
            'detalle'=>['type'=>Form::INPUT_TEXT,],
            'origen_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysOrigenesBienes::find()->asArray()->all(),'id','nombre'),'options'=>['id'=>'origen','onchange'=>'']]],

            'factura_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                'options'=>['id'=>'factura','placeholder'=>'Seleccionar factura', 'onchange'=>''],'pluginOptions' => [
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
                'options'=>['id'=>'documento-registrado','placeholder'=>'Seleccionar documento registrado', 'onchange'=>''],'pluginOptions' => [
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
            'propio'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
                'pluginOptions'=>['threeState'=>false,
                    //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                    'iconNull'=>'<i class="glyphicon"></i>']]],
            //'factura'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],
            //'documento'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],

            'metodo_medicion_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysMetodosMedicion::find()->all(),'id','nombre',function($model){ return $model->modelo->nombre;}), 'pluginOptions'=>['allowClear' => true],'options'=>['id'=>'metodo-medicion','placeholder'=>'Seleccionar método de medición', 'onchange'=>'']]],
            // Mejora
            'mejora'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
                'pluginOptions'=>['threeState'=>false,
                    //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                    'iconNull'=>'<i class="glyphicon"></i>']]
            ], //['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>false,],'options'=>['onchange'=>'']],
            'perdida_reverso'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
                'pluginOptions'=>['threeState'=>false,
                    //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                    'iconNull'=>'<i class="glyphicon"></i>']]],

            'proc_productivo'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
                'pluginOptions'=>['threeState'=>false,
                    //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                    'iconNull'=>'<i class="glyphicon"></i>']]
            ],//['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>false,]],
            // Si proc_productivo es true
            'directo'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
                'pluginOptions'=>['threeState'=>false,
                    //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                    'iconNull'=>'<i class="glyphicon"></i>']],
                'columnOptions'=>['hidden'=>true,]
            ],//['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true,]],
            // Si proceso productivo es false.
            'proc_ventas'=> ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
                'pluginOptions'=>['threeState'=>false,
                    //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                    'iconNull'=>'<i class="glyphicon"></i>']],
                'columnOptions'=>['hidden'=>true,]

            ]//['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>false,]],

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
        $attributes['nacional'] = ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className(),'options'=>[
            'pluginOptions'=>['threeState'=>false,
                //'iconChecked'=>'<i class="glyphicon glyphicon-plus"></i>',
                'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                'iconNull'=>'<i class="glyphicon"></i>'],
        ],'columnOptions'=>['hidden'=>true,]
        ];//['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true,],'options'=>['onchange'=>'']];

        return $attributes;*/
    }
}
