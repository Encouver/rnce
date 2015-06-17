<?php

namespace common\models\p;
use kartik\builder\Form;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\models\p\SysNaturalesJuridicas;
use common\models\a\ActivosBienes;
use Yii;
/**
 * This is the model class for table "polizas_contratadas".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property string $numero_contrato
 * @property string $fecha_suscripcion
 * @property string $fecha_inicio
 * @property string $fecha_finalizacion
 * @property integer $duracion
 * @property string $tipo_poliza
 * @property string $monto_asegurado
 * @property string $monto_contrato
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $natural_juridica_id
 * @property integer $bien_id
 *
 * @property ActivosBienes $bien
 * @property Contratistas $contratista
 * @property SysNaturalesJuridicas $naturalJuridica
 */
class PolizasContratadas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polizas_contratadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'numero_contrato', 'fecha_suscripcion', 'fecha_inicio', 'fecha_finalizacion', 'duracion', 'tipo_poliza', 'monto_asegurado', 'natural_juridica_id', 'monto_contrato','bien_id'], 'required'],
            [['contratista_id', 'duracion', 'creado_por', 'actualizado_por', 'natural_juridica_id', 'bien_id'], 'integer'],
            [['fecha_suscripcion', 'fecha_inicio', 'fecha_finalizacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_poliza'], 'string'],
            [['monto_asegurado', 'monto_contrato'], 'number'],
            [['sys_status'], 'boolean'],
            [['bien_id'],'validarbien'],
            [['numero_contrato'], 'string', 'max' => 255]
        ];
    }
     public function Validarbien($attribute)
    {   
       
        $poliza = PolizasContratadas::findOne(['bien_id'=>$this->bien_id]);

        if (isset($poliza) && $poliza->id!=$this->id) {
            $this->addError($attribute,'Ya existe este registro' );
            
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'numero_contrato' => Yii::t('app', 'Numero Contrato'),
            'fecha_suscripcion' => Yii::t('app', 'Fecha Suscripcion'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_finalizacion' => Yii::t('app', 'Fecha Finalizacion'),
            'duracion' => Yii::t('app', 'Duracion'),
            'tipo_poliza' => Yii::t('app', 'Tipo Poliza'),
            'monto_asegurado' => Yii::t('app', 'Monto Asegurado'),
            'monto_contrato' => Yii::t('app', 'Monto Contrato'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
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
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaturalJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridica_id']);
    }
     public function getFormAttribs() {
    
        
      $poliza= [ 'PATRIMONIALES' => 'PATRIMONIALES', 'PERSONAS' => 'PERSONAS',];
     $persona = empty($this->natural_juridica_id) ? '' : SysNaturalesJuridicas::findOne($this->natural_juridica_id)->denominacion;
     $bien = empty($this->bien_id) ? '' : $this->bien->Etiqueta();
    
     return [
           'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
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
          'numero_contrato'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Nombre del proyecto']],
            'fecha_suscripcion'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
            ], 
            'fecha_inicio'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
            ],
            'fecha_finalizacion'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
            ],
        'duracion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Nombre del proyecto']],
        'tipo_poliza'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$poliza , 'options'=>['prompt'=>'Seleccione el tipo de contrato']],
        'bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                'initValueText' => $bien,
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['activos-bienes/bienes-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(bien_id) { return bien_id.text; }'),
                'templateSelection' => new JsExpression('function (bien_id) { return bien_id.text; }'),
                ],]],
        'monto_asegurado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Nombre del proyecto']],
        'monto_contrato'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Monto contrato']],
    ];
    
    
    }
}
