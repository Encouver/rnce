<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\SysNaturalesJuridicas;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * This is the model class for table "empresas_relacionadas".
 *
 * @property integer $id
 * @property string $tipo_relacion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property integer $persona_juridica_id
 * @property integer $persona_contacto_id
 * @property integer $objeto_empresa
 *
 * @property CuentasB2OtrasCuentasPorCobrarE[] $cuentasB2OtrasCuentasPorCobrarEs
 * @property CuentasBb1CuentasPorPagarComerciales[] $cuentasBb1CuentasPorPagarComerciales
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 * @property SysNaturalesJuridicas $personaJuridica
 * @property SysNaturalesJuridicas $personaContacto
 * @property ObjetosEmpresas[] $objetosEmpresas
 */
class EmpresasRelacionadas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $nacionalidad;
    public static function tableName()
    {
        return 'empresas_relacionadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_relacion', 'contratista_id', 'persona_juridica_id', 'persona_contacto_id','nacionalidad','objeto_empresa'], 'required'],
            [['tipo_relacion','nacionalidad'], 'string'],
            [['creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id', 'persona_juridica_id', 'persona_contacto_id'], 'integer'],
            [['fecha_inicio', 'fecha_fin', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
           [['fecha_inicio','fecha_fin'], 'required', 'when' => function ($model) {
                return $model->nacionalidad== 'EXTRANJERA';
            }, 'whenClient' => "function (attribute, value) {
                return $('#empresasrelacionadas-nacionalidad').val()=='EXTRANJERA';
            }"],
            [['documento_registrado_id'], 'required', 'when' => function ($model) {
                return ($model->nacionalidad== 'NACIONAL' && ($model->tipo_relacion=='ACCIONISTA' || $model->tipo_relacion=='INVERSION'));
            }, 'whenClient' => "function (attribute, value) {
                return $('#empresasrelacionadas-nacionalidad').val() =='NACIONAL' && ($('#empresasrelacionadas-tipo_relacion').val() =='ACCIONISTA' || $('#empresasrelacionadas-tipo_relacion').val() =='INVERSION');
            }"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_relacion' => Yii::t('app', 'Tipo Relacion'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha Fin'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'persona_juridica_id' => Yii::t('app', 'Empresa'),
            'persona_contacto_id' => Yii::t('app', 'Persona de Contacto'),
            'nacionalidad' => Yii::t('app', 'Tipo Nacionalidad'),
            'objeto_empresa' => Yii::t('app', 'Objeto empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasB2OtrasCuentasPorCobrarEs()
    {
        return $this->hasMany(CuentasB2OtrasCuentasPorCobrarE::className(), ['empresa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasBb1CuentasPorPagarComerciales()
    {
        return $this->hasMany(CuentasBb1CuentasPorPagarComerciales::className(), ['proveedor_id' => 'id']);
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
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'persona_juridica_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaContacto()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'persona_contacto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosEmpresas()
    {
        return $this->hasMany(ObjetosEmpresas::className(), ['empresa_relacionada_id' => 'id']);
    }
     public function getFormAttribs() {
         $vacio=['DISTRIBUIDOR'];
         $objeto=['DISTRIBUIDOR','DISTRIBUIDOR AUTORIZADO'];
            $relacion=[ 'ACCIONISTA' => 'ACCIONISTA', 'INVERSION' => 'INVERSION', 'CLIENTE' => 'CLIENTE', 'PROVEEDOR' => 'PROVEEDOR', 'CONVENIO' => 'CONVENIO', 'FILIAL / SUBSIDIARIA' => 'FILIAL / SUBSIDIARIA', ];
             $nacionalidad=['NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA',];
              $empresa = empty($this->persona_juridica_id) ? '' : SysNaturalesJuridicas::findOne($this->persona_juridica_id)->denominacion;
              $persona = empty($this->persona_contacto_id) ? '' : SysNaturalesJuridicas::findOne($this->persona_contacto_id)->denominacion;
           //   $valor = empty($this->objeto_empresa) ? $vacio : $objeto;
              $data = [
                'PRODUCTOR'=>'PRODUCTOR', 'FABRICANTE'=>'FABRICANTE','FABRICANTE IMPORTADOR'=>'FABRICANTE IMPORTADOR','DISTRIBUIDOR'=>'DISTRIBUIDOR','DISTRIBUIDOR AUTORIZADO'=>'DISTRIBUIDOR AUTORIZADO','DISTRIBUIDOR IMPORTADOR'=>'DISTRIBUIDOR IMPORTADOR','DISTRIBUIDOR IMPORTADOR AUTORIZADO'=>'DISTRIBUIDOR IMPORTADOR AUTORIZADO',
                'SERVICIOS BASICOS'=>'SERVICIOS BASICOS' ,'SERVICIOS PROFESIONALES'=>'SERVICIOS PROFESIONALES','SERVICIOS COMERCIALES'=>'SERVICIOS COMERCIALES','SERVICIOS COMERCIALES'=>'SERVICIOS COMERCIALES','SERVICIOS COMERCIALES AUTORIZADO'=>'SERVICIOS COMERCIALES AUTORIZADO',
                'OBRAS' => "OBRAS"
                ];
              return [
           'nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$nacionalidad,'options'=>['prompt'=>'Seleccione Nacionalidad']],
                'tipo_relacion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$relacion,'options'=>['prompt'=>'Tipo de relacion']],
            'persona_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $empresa,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term,juridica:true}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
            ],]],
                'objeto_empresa'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                //'value' => ['DISTRIBUIDOR','FABRICANTE'], // initial value
                'data' => $data,
                'options'=>['placeholder' => 'Objeto empresa ...'],'pluginOptions' => [
                 'tags' => true,
                'tokenSeparators' => [',', ' '],
                ],]],
                  
                 'persona_contacto_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term,juridica:false}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
            ],]],
           'documento_registrado_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                 'options'=>['placeholder'=>'Seleccionar documento registrado'],'pluginOptions' => [
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
            'fecha_inicio'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                 ],
            'fecha_fin'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                 ],
              
            ];
        
        
        return false;
    }
}
