<?php

namespace common\models\p;
use kartik\builder\Form;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\AccionistasOtros;
use common\models\p\SysNaturalesJuridicas;
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
            [['declaracion_jurada', 'comisario', 'sys_status', 'auditor', 'responsable_contabilidad', 'informe_conversion','actual'], 'boolean'],
            [['tipo_profesion'], 'string'],
            [['colegiatura'],'required','on'=>'responsable'],
            [['colegiatura','fecha_vencimiento','tipo_profesion'],'required','on'=>'auditor'],
            [['fecha_informe','tipo_profesion'],'required','on'=>'profesional'],
            [['tipo_profesion','fecha_carta','fecha_vencimiento','declaracion_jurada','actual'],'required','on'=>'comisario'],
            [['documento_registrado_id', 'contratista_id', 'natural_juridica_id'], 'integer'],
            [['colegiatura'], 'string', 'max' => 255],
            [['comisario', 'auditor', 'informe_conversion', 'responsable_contabilidad'],'default','value'=>false],
             ['declaracion_jurada', 'compare', 'message' => 'Debe aceptar la declaracion jurada', 'operator'=> '==', 'compareValue'=>true, 'when' => function ($model) {
                return $model->natural_juridica_id != '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#comisariosauditores-natural_juridica_id').val() !='';
            }"],
            [['colegiatura'], 'required', 'when' => function ($model) {
                return $model->tipo_profesion == "CONTADOR PUBLICO";
            }, 'whenClient' => "function (attribute, value) {
                return $('#comisariosauditores-tipo_profesion').val() == 'CONTADOR PUBLICO';
            }"],
            [['natural_juridica_id'],'validarnatural'],
            [['colegiatura'],'validarcolegiatura'],
        ];
    }
    public function Validarnatural($attribute){
        $accionista= AccionistasOtros::findOne(['natural_juridica_id'=>$this->natural_juridica_id]);
        if(isset($accionista)){
             $this->addError($attribute,'El comisario no puede formar parte de los accionista o junta directiva');
        }else{
            $comisario_auditor=ComisariosAuditores::findOne(['natural_juridica_id' => $this->natural_juridica_id]);
            if($this->comisario){
                $comisario_auditor=ComisariosAuditores::findOne(['natural_juridica_id' => $this->natural_juridica_id,'documento_registrado_id'=>$this->documento_registrado_id]);
            }
            if (isset($comisario_auditor) && $comisario_auditor->id!=$this->id) {
                $this->addError($attribute,'Registro existente' );
                }
            
        }
       
    }
     public function Validarcolegiatura($attribute){
        if($this->tipo_profesion!='CONTADOR PUBLICO'){
            $this->colegiatura=null;
        }
       
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
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'contratista_id' => Yii::t('app', 'Contratista'),
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
            'actual' => Yii::t('app', 'Actual'),
        ];
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
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }
    public function getFormAttribs($id) {
        //$data=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
         $persona = empty($this->natural_juridica_id) ? '' : SysNaturalesJuridicas::findOne($this->natural_juridica_id)->denominacion;
        if($id=="comisario"){
        $profesiones =[ 'CONTADOR PUBLICO' => 'CONTADOR PUBLICO', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'ECONOMISTA' => 'ECONOMISTA', ];
    return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
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
          'colegiatura'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura'],'hint'=>'Solo contador publico'],
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
              $this->tipo_profesion='CONTADOR PUBLICO';
             return [
                 'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                 'initValueText' => $persona,
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
        'tipo_profesion'=>['type'=>Form::INPUT_HIDDEN,'label'=>false],
      
      
    ];
        }
      if($id=='profesional'){
          
        $profesiones =[ 'CONTADOR PUBLICO' => 'CONTADOR PUBLICO', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'ECONOMISTA' => 'ECONOMISTA', ];
    return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
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
      if($id=='responsable'){
          
          $this->tipo_profesion='CONTADOR PUBLICO';
    return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
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
         'tipo_profesion'=>['type'=>Form::INPUT_HIDDEN,'label'=>false],
    ];
      }
    
    }
     public function Modificacionactual(){
       
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       
       if(isset($registro)){
         $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);  
       }else{
           $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>-100]); 
       }
       return $modificacion;
    }
    public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
                $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
               if(isset($modificacion)){
                    if(!$modificacion->comisario && $this->comisario){
                         return true;
                    }else{
                        $this->actual=false;
                    }
               }else{
                   return true;
               }
           }
           if($this->comisario){
               $comisario_auditor= ComisariosAuditores::findAll(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id,'comisario'=>true]);
                if(count($comisario_auditor)>=2){
               
                return true;   
                }else{
                    $this->documento_registrado_id=$registro->id;
                    if(is_null($this->actual)){
                        $this->actual=true;
                    }
                    return false;
                }
           }else{
               return false;
           }
            
        }else{
            if($this->comisario){
            return true;
            }else{
                
                return false;
            }
        }
    }
   
   
}
