<?php

namespace common\models\p;
use kartik\builder\Form;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "public.comisarios_auditores".
 *
 * @property integer $id
 * @property string $fecha_vencimiento
 * @property boolean $declaracion_jurada
 * @property string $tipo_profesion
 * @property string $fecha_carta
 * @property string $colegiatura
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 * @property boolean $comisario
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property boolean $auditor
 * @property boolean $responsable_contabilidad
 * @property boolean $informe_conversion
 * @property integer $natural_juridica_id
 * @property integer $fecha_informe
 */
class ComisariosAuditores extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.comisarios_auditores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'contratista_id', 'natural_juridica_id'], 'required'],
            [['fecha_vencimiento','fecha_informe', 'fecha_carta', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['declaracion_jurada', 'comisario', 'sys_status', 'auditor', 'responsable_contabilidad', 'informe_conversion'], 'boolean'],
            [['tipo_profesion'], 'string'],
            [['tipo_profesion','colegiatura','fecha_carta','fecha_vencimiento','declaracion_jurada'],'required','on'=>'comisario'],
            [['documento_registrado_id', 'contratista_id', 'natural_juridica_id'], 'integer'],
            [['colegiatura'], 'string', 'max' => 255],
            [['comisario', 'auditor', 'informe_conversion', 'responsable_contabilidad'],'default','value'=>false],
             ['declaracion_jurada', 'compare', 'message' => 'Debe aceptar la declaracion jurada', 'operator'=> '==', 'compareValue'=>true, 'when' => function ($model) {
                return $model->natural_juridica_id != '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#comisariosauditores-natural_juridica_id').val() !='';
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
            'fecha_vencimiento' => Yii::t('app', 'Fecha Vencimiento'),
            'declaracion_jurada' => Yii::t('app', 'Declaracion Jurada'),
            'tipo_profesion' => Yii::t('app', 'Profesion'),
            'fecha_carta' => Yii::t('app', 'Fecha de Aceptacion'),
            'colegiatura' => Yii::t('app', 'Colegiatura'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'comisario' => Yii::t('app', 'Comisario'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'auditor' => Yii::t('app', 'Auditor'),
            'responsable_contabilidad' => Yii::t('app', 'Responsable Contabilidad'),
            'informe_conversion' => Yii::t('app', 'Informe Conversion'),
            'natural_juridica_id' => Yii::t('app', 'Persona Natural'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
        ];
    }
    
    
    public function getFormAttribs($id) {
        //$data=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
        if($id=="comisario"){
        $profesiones =[ 'CONTADOR PUBLICO' => 'CONTADOR PUBLICO', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'ECONOMISTA' => 'ECONOMISTA', ];
    return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'options'=>[],'pluginOptions' => [
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
          'tipo_profesion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$profesiones , 'options'=>['prompt'=>'Seleccione profesion']],
         'colegiatura'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
        'fecha_carta'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
        ], 
        'fecha_vencimiento'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
        ],
        'declaracion_jurada'=>['type'=>Form::INPUT_CHECKBOX],
      
    ];
        }
        if($id=="auditor"){
             return [
                 'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
        ],]],
         'colegiatura'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
        'fecha_vencimiento'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
        ],
      
      
    ];
        }
      if('profesional'){
          
        $profesiones =[ 'CONTADOR PUBLICO' => 'CONTADOR PUBLICO', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'ECONOMISTA' => 'ECONOMISTA', ];
    return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
        ],]],
          'tipo_profesion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$profesiones , 'options'=>['prompt'=>'Seleccione profesion']],
         'colegiatura'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
       
        'fecha_informe'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
        ],
    ];
      }
    
    }
   
   
}
