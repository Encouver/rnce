<?php

namespace common\models\p;
use kartik\builder\Form;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\ModificacionesActas;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ActasConstitutivas;
use Yii;
/**
 * This is the model class for table "accionistas_otros".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $natural_juridica_id
 * @property string $porcentaje_accionario
 * @property string $valor_compra
 * @property string $fecha
 * @property boolean $accionista
 * @property boolean $junta_directiva
 * @property boolean $rep_legal
 * @property integer $documento_registrado_id
 * @property string $repr_legal_vigencia
 * @property integer $empresa_fusionada_id
 * @property string $tipo_obligacion
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property boolean $empresa_relacionada
 * @property string $tipo_cargo
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 * @property EmpresasFusionadas $empresaFusionada
 * @property SysNaturalesJuridicas $naturalJuridica
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property PagosAccionistasDecretos[] $pagosAccionistasDecretos
 */
class AccionistasOtros extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accionistas_otros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'natural_juridica_id', 'documento_registrado_id', 'tipo_obligacion'], 'required'],
            [['natural_juridica_id','repr_legal_vigencia','tipo_obligacion'], 'required','on'=>'representante'],
            [['tipo_cargo'], 'required','on'=>'junta'],
            [['porcentaje_accionario'], 'required','on'=>'accionista'],
            [['contratista_id', 'natural_juridica_id', 'documento_registrado_id', 'empresa_fusionada_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['porcentaje_accionario', 'valor_compra'], 'number'],
            [['fecha', 'repr_legal_vigencia', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el','actual'], 'safe'],
            [['accionista', 'junta_directiva', 'rep_legal', 'sys_status', 'empresa_relacionada','actual'], 'boolean'],
            [['tipo_obligacion', 'tipo_cargo'], 'string'],
            [['repr_legal_vigencia'],'validarrepresentante'],
            [['tipo_cargo'],'validarcargo'],
            [['porcentaje_accionario'],'validarporcentaje'],
            [['natural_juridica_id'],'validarnatural'],
           /* ['accionista', 'required', 'when' => function ($model) {
               return $model->porcentaje_accionario != "";
           }, 'whenClient' => "function (attribute, value) {
               return $('#accionistasotros-porcentaje_accionario').val() != '' &&  $('#accionistasotros-accionista').is(':checked');
           }"]*/
        ];
    }
     public function Validarporcentaje($attribute)
    {
       $porcentaje_actual= $this->sumarporcentaje()+$this->porcentaje_accionario;
         if($porcentaje_actual>100){
               $this->addError($attribute,'Porcentaje excedente');
          }else{
              if($this->porcentaje_accionario<=0){
               $this->addError($attribute,'Porcentaje debe ser mayor a 0');
                }
          }
    }
     public function Validarnatural($attribute)
    {   
        if($this->accionista){
        $accionista= AccionistasOtros::findOne(['documento_registrado_id'=>$this->documento_registrado_id,'accionista'=>true,'natural_juridica_id'=>$this->natural_juridica_id]);
        }else{
            if($this->junta_directiva){
                $accionista= AccionistasOtros::findOne(['documento_registrado_id'=>$this->documento_registrado_id,'junta_directiva'=>true,'natural_juridica_id'=>$this->natural_juridica_id]);
            }else{
                if($this->rep_legal){
                    $accionista= AccionistasOtros::findOne(['documento_registrado_id'=>$this->documento_registrado_id,'rep_legal'=>true,'natural_juridica_id'=>$this->natural_juridica_id]);
                } 
            }
        }
        if (isset($accionista) && $accionista->id!=$this->id) {
            $this->addError($attribute,'Ya existe un registro actual' );
            
        }
    }
    public function Validarrepresentante($attribute)
    {
        if (AccionistasOtros::find()->where(['documento_registrado_id' => $this->documento_registrado_id, 'rep_legal'=>true])->exists() && AccionistasOtros::findOne(['documento_registrado_id' => $this->documento_registrado_id, 'rep_legal'=>true])->id!=$this->id && $this->accionista!=true) {
            $this->addError($attribute,'Ya existe un representante legal asociado' );
            
        }
    }
     public function Validarcargo($attribute)
    {
         $accionista=AccionistasOtros::findOne(['documento_registrado_id' => $this->documento_registrado_id, 'tipo_cargo'=>$this->tipo_cargo,'junta_directiva'=>true]);
        if (isset($accionista) && $accionista->id!=$this->id && !$this->accionista) {
                $this->addError($attribute,'Ya existe este cargo asignado' );
        }else{
            if($this->naturalJuridica->juridica){
            $this->addError($attribute,'Las empresas no pueden ser parte de la junta directiva' );
            }
        }
        
    }
     public function sumarporcentaje($sum=true)
    {
       $suma=0;
       $accionista= AccionistasOtros::findAll(['documento_registrado_id'=>$this->documento_registrado_id,'accionista'=>true]);
        
      
        if(isset($accionista)){
             foreach ($accionista as $accion) {
                      $suma=$suma+$accion->porcentaje_accionario;
            }
           if(!$this->isNewRecord && $sum){
             $accion= AccionistasOtros::findOne($this->id);
               $suma=$suma-$accion->porcentaje_accionario;
                 
           }
        }
       
        
        return $suma;
    }
    /* public function Validarnatural($attribute)
    {
         $accion= AccionistasOtros::findOne(['contratista_id' => Yii::$app->user->identity->contratista_id, 'documento_registrado_id'=>$this->documento_registrado_id,'natural_juridica_id'=>$this->natural_juridica_id]);
      if (isset($accion)&& ($this->isNewRecord || $accion->id!=$this->id)) {
          if($this->scenario=='principal'){
              $this->addError($attribute,'Ya existe esta persona asignada' );
          }else{
              $this->tipo_obligacion= $accion->tipo_obligacion;
              $this->porcentaje_accionario= $accion->porcentaje_accionario;
              $this->accionista= $accion->accionista;
             
                  if(!$accion->junta_directiva){
                    $this->rep_legal= false;
                    $this->repr_legal_vigencia= null;
                  }else{
                       
                        $this->addError($attribute,'Ya existe esta persona asignada' );
                        
                  }
                  
              
          }
       }else{
           $accion= AccionistasOtros::findOne(['contratista_id' => Yii::$app->user->identity->contratista_id, 'actual'=>true,'natural_juridica_id'=>$this->natural_juridica_id]);
           if (isset($accion)&& ($this->isNewRecord || $accion->id!=$this->id) && $this->scenario!='principal') {
               $this->tipo_obligacion= $accion->tipo_obligacion;
               $this->porcentaje_accionario= $accion->porcentaje_accionario;
               $this->accionista= $accion->accionista;
                if($this->scenario=='representante'){
               
                    $this->junta_directiva= $accion->junta_directiva;
                    $this->tipo_cargo= $accion->tipo_cargo;
                }else{
                     $this->rep_legal= false;
                    $this->repr_legal_vigencia= null;
                }
                
           }else{
                if(!$this->isNewRecord && $this->scenario=='representante'){
                    $accion= AccionistasOtros::findOne($this->id);
                    if($accion->natural_juridica_id!=$this->natural_juridica_id){
                        if($accion->accionista || $accion->junta_directiva){
                            $this->accionista=false;
                            $this->junta_directiva=false;
                            $this->porcentaje_accionario=null;
                            $this->tipo_cargo=null;
                        }
                    }
                    
                }
                if(!$this->isNewRecord && $this->scenario=='junta'){
                    $accion= AccionistasOtros::findOne($this->id);
                    if($accion->natural_juridica_id!=$this->natural_juridica_id){
                        if($accion->accionista){
                            $this->accionista=false;
                            
                            $this->porcentaje_accionario=null;
                            $this->rep_legal= false;
                            $this->repr_legal_vigencia= null;
                            
                        }
                    }
                }
              
           }
           
           
           
       }
       
    }*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica ID'),
            'porcentaje_accionario' => Yii::t('app', 'Porcentaje Accionario'),
            'valor_compra' => Yii::t('app', 'Valor Compra'),
            'fecha' => Yii::t('app', 'Fecha'),
            'accionista' => Yii::t('app', 'Accionista'),
            'junta_directiva' => Yii::t('app', 'Junta Directiva'),
            'rep_legal' => Yii::t('app', 'Rep Legal'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'repr_legal_vigencia' => Yii::t('app', 'Repr Legal Vigencia'),
            'empresa_fusionada_id' => Yii::t('app', 'Empresa Fusionada ID'),
            'tipo_obligacion' => Yii::t('app', 'Tipo Obligacion'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'empresa_relacionada' => Yii::t('app', 'Empresa Relacionada'),
            'tipo_cargo' => Yii::t('app', 'Tipo Cargo'),
            'actual' => Yii::t('app', 'Tipo Cargo'),
        ];
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
    public function getEmpresaFusionada()
    {
        return $this->hasOne(EmpresasFusionadas::className(), ['id' => 'empresa_fusionada_id']);
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
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['accionista_otro' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagosAccionistasDecretos()
    {
        return $this->hasMany(PagosAccionistasDecretos::className(), ['accionista_id' => 'id']);
    }
     public function getFormAttribs() {
         $persona = empty($this->natural_juridica_id) ? '' : SysNaturalesJuridicas::findOne($this->natural_juridica_id)->denominacion;
        $cargos=[ 'PRESIDENTE' => 'PRESIDENTE', 'DIRECTOR' => 'DIRECTOR', 'VOCERO DE LA UNIDAD DE ADMINISTRACION' => 'VOCERO DE LA UNIDAD DE ADMINISTRACION', 'VOCERO DE LA UNIDAD DE GESTION PRODUCTIVA' => 'VOCERO DE LA UNIDAD DE GESTION PRODUCTIVA', 'VOCERO DE LA UNIDAD DE FORMACION' => 'VOCERO DE LA UNIDAD DE FORMACION', 'VOCERO DE LA UNIDAD DE CONTRALORIA SOCIAL' => 'VOCERO DE LA UNIDAD DE CONTRALORIA SOCIAL', 'INSTANCIA DE ADMINISTRACION' => 'INSTANCIA DE ADMINISTRACION', 'INSTANCIA DE CONTROL Y EVALUACION' => 'INSTANCIA DE CONTROL Y EVALUACION', 'INSTANCIA DE EDUCACION' => 'INSTANCIA DE EDUCACION', ];
       $obligacion=[ 'FIRMA CONJUNTA' => 'FIRMA CONJUNTA', 'FIRMA SEPARADA' => 'FIRMA SEPARADA', ];
        if($this->scenario=='accionista'){
       return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
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
        'porcentaje_accionario'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Nombre y Apellido']],
        'tipo_obligacion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$obligacion,'options'=>['prompt'=>'Seleccione obligacion']],
        'tipo_cargo'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$cargos,'options'=>['prompt'=>'Seleccione cargo'],'hint'=>'Solo si el accionista forma parte de la junta directiva',],
        'documento_registrado_id'=>['type'=>Form::INPUT_HIDDEN,'label'=>false],
    
           ];
       
        }
        if($this->scenario=='representante'){
             return [
            'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
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
        'repr_legal_vigencia'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                 ],
        'tipo_obligacion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$obligacion,'options'=>['prompt'=>'Seleccione obligacion']],
        'documento_registrado_id'=>['type'=>Form::INPUT_HIDDEN,'label'=>false],
       
           ];
        }
        if($this->scenario=='junta'){
             return [
            'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
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
       'tipo_cargo'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$cargos,'options'=>['prompt'=>'Seleccione cargo']],
        'tipo_obligacion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$obligacion,'options'=>['prompt'=>'Seleccione obligacion']],
        'documento_registrado_id'=>['type'=>Form::INPUT_HIDDEN,'label'=>false],
       
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
    public function Existeacta(){
       
       $acta = ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);      
       
       if(isset($acta)){
         return true;  
       }
       return false;
    }
   
    public function Existeregistro($id){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
                $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
               if(isset($modificacion)){
                    if($modificacion->representante_legal || $modificacion->junta_directiva){
                        if($modificacion->representante_legal && $id=='representante'){
                            $accion= AccionistasOtros::findOne(['documento_registrado_id'=>$modificacion->documento_registrado_id,'rep_legal'=>true]);
                            if(isset($accion)){
                                return true;
                            }else{
                                $this->rep_legal=true;
                            }
                      
                        }else{
                            if($modificacion->junta_directiva && $id=='junta'){
                                    $this->junta_directiva=true;
                                }else{
                                    return true;
                                }
                      
                            
                        }
                    }else{
                        return true;
                    }
               }else{
                   return true;
               }
           }else{
               $this->actual=true;
               switch ($id){
                    case 'accionista':
                       $this->accionista=true;
                    break;
                    case 'representante':
                        $representante = AccionistasOtros::findOne(['documento_registrado_id'=>$registro->id,'rep_legal'=>true]);
                        if(isset($representante)){
                            return true;
                        }
                       $this->rep_legal=true;
                    break;
                    case 'junta':
                       $this->junta_directiva=true;
                    break;
                    default:
                        return true;
                        break;
               }
              
           }
          
                $this->documento_registrado_id=$registro->id;
                return false;
           
        }else{
            return true;
        }
    }
}
