<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\CertificacionesAportes;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use common\models\p\DenominacionesComerciales;
use Yii;
/**
 * This is the model class for table "certificados".
 *
 * @property integer $id
 * @property integer $numero_asociacion
 * @property integer $numero_aportacion
 * @property integer $numero_rotativo
 * @property integer $numero_inversion
 * @property string $valor_asociacion
 * @property string $valor_aportacion
 * @property string $valor_rotativo
 * @property string $valor_inversion
 * @property string $tipo_certificado
 * @property boolean $suscrito
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class Certificados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $numero_asociacion_pagada;
    public $numero_aportacion_pagada;
    public $numero_rotativo_pagada;
    public $numero_inversion_pagada;
    public $capital_pagado;

    public static function tableName()
    {
        return 'certificados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documento_registrado_id', 'contratista_id','certificacion_aporte_id'], 'required'],
            [['numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id','certificacion_aporte_id'], 'integer'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion','capital','capital_pagado'], 'number'],
            [['tipo_certificado'], 'string'],
            ['capital', 'validarcapital'],
            ['capital_pagado', 'validarcapitalpagado'],
            ['valor_asociacion', 'validarmaximoasociacion'],
            ['valor_aportacion', 'validarmaximoaportacion'],
            ['valor_inversion', 'validarmaximoinversion'],
            ['valor_rotativo', 'validarmaximorotativo'],
            ['numero_asociacion_pagada', 'validarnumeroasociacionpagada'],
            ['numero_aportacion_pagada', 'validarnumeroaportacionpagada'],
            ['numero_rotativo_pagada', 'validarnumerorotativopagada'],
            ['numero_inversion_pagada', 'validarnumeroinversionpagada'],

            [['capital','numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'valor_asociacion', 'valor_aportacion', 'valor_rotativo','valor_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'capital_pagado'], 'required','on'=>'principal'],
            [['suscrito', 'documento_registrado_id', 'contratista_id'], 'required'],
            [['suscrito', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
           
        ];
    }
    public function validarcapital($attribute){
         
              if(($this->numero_asociacion*$this->valor_asociacion)+($this->numero_aportacion*$this->valor_aportacion)+($this->numero_rotativo*$this->valor_rotativo)+($this->numero_inversion*$this->valor_inversion) < $this->capital){
                  $this->addError($attribute,'Faltan capital por fraccionar');
              }
          
    }
      public function validarcapitalpagado($attribute){
          if($this->capital_pagado>$this->capital){
               $this->addError($attribute,'Valor Capital pagada invalido');
          }else{
              if(($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion)+($this->numero_rotativo_pagada*$this->valor_rotativo)+($this->numero_inversion_pagada*$this->valor_inversion) < $this->capital_pagado){
                  $this->addError($attribute,'Faltan capital pagado por fraccionar');
              }
          }
    }
    public function validarmaximoasociacion($attribute){
        
          if($this->valor_asociacion*$this->numero_asociacion > $this->capital){
               $this->addError($attribute,'Valor Asociacion pasa el maximo valido');
          } 
    }
    public function validarmaximoaportacion($attribute){
        
          if(($this->valor_asociacion*$this->numero_asociacion)+($this->valor_aportacion*$this->numero_aportacion)> $this->capital){
               $this->addError($attribute,'Valor Inversion pasa el maximo valido');
          } 
    }
    public function validarmaximoinversion($attribute){
        
          if(($this->valor_asociacion*$this->numero_asociacion)+($this->valor_aportacion*$this->numero_aportacion) +($this->valor_inversion*$this->numero_inversion) > $this->capital){
               $this->addError($attribute,'Valor Aportacion pasa el maximo valido');
          } 
    }
     public function validarmaximorotativo($attribute){
        
          if(($this->valor_asociacion*$this->numero_asociacion)+($this->valor_aportacion*$this->numero_aportacion) +($this->valor_inversion*$this->numero_inversion) +($this->valor_rotativo*$this->numero_rotativo)> $this->capital){
               $this->addError($attribute,'Valor Rotativo pasa el maximo valido');
          } 
    }
     public function validarnumeroasociacionpagada($attribute){
          if($this->numero_asociacion_pagada>$this->numero_asociacion){
               $this->addError($attribute,'Numero Asociacion pagada invalido');
          }else{
              if(($this->capital_pagado<$this->capital) && ($this->numero_asociacion_pagada*$this->valor_asociacion > $this->capital_pagado)){
               $this->addError($attribute,'Numero Asociacion pagada sobrepasa valor valido');
            } 
          }
    }
    
    
    public function validarnumeroaportacionpagada($attribute){
          if($this->numero_aportacion_pagada>$this->numero_aportacion){
               $this->addError($attribute,'Numero Aportacion pagada invalido');
          }else{
               if(($this->capital_pagado<$this->capital) && (($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion) > $this->capital_pagado)){
               $this->addError($attribute,'Numero Aportacion pagada sobrepasa valor valido');
                } 
          }
    }
     
  
   
    public function validarnumerorotativopagada($attribute){
          if($this->numero_rotativo_pagada>$this->numero_rotativo){
               $this->addError($attribute,'Numero Rotativo pagada invalido');
          }else{
               if(($this->capital_pagado<$this->capital) && (($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion)+($this->numero_rotativo_pagada*$this->valor_rotativo) > $this->capital_pagado)){
               $this->addError($attribute,'Numero Rotativo pagada sobrepasa valor valido');
                }
          }
    }
   
            
     public function validarnumeroinversionpagada($attribute){
          if($this->numero_inversion_pagada>$this->numero_inversion){
               $this->addError($attribute,'Numero Inversion pagada invalido');
          }else{
              if(($this->capital_pagado<$this->capital) && (($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion)+($this->numero_rotativo_pagada*$this->valor_rotativo)+($this->numero_inversion_pagada*$this->valor_inversion) > $this->capital_pagado)){
               $this->addError($attribute,'Numero Inversion pagada sobrepasa valor valido');
            } 
          }
    }
  
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_asociacion' => Yii::t('app', 'Numero Asociacion'),
            'numero_aportacion' => Yii::t('app', 'Numero Aportacion'),
            'numero_rotativo' => Yii::t('app', 'Numero Rotativo'),
            'numero_inversion' => Yii::t('app', 'Numero Inversion'),
            'valor_asociacion' => Yii::t('app', 'Valor Asociacion'),
            'valor_aportacion' => Yii::t('app', 'Valor Aportacion'),
            'valor_rotativo' => Yii::t('app', 'Valor Rotativo'),
            'valor_inversion' => Yii::t('app', 'Valor Inversion'),
            'tipo_certificado' => Yii::t('app', 'Tipo Certificado'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'numero_asociacion_pagada' => Yii::t('app', 'Numero Asociacion Pagada'),
            'numero_aportacion_pagada' => Yii::t('app', 'Numero Aportacion Pagada'),
            'numero_rotativo_pagada' => Yii::t('app', 'Numero Rotativo Pagada'),
            'numero_inversion_pagada' => Yii::t('app', 'Numero Inversion Pagada'),
            'capital' => Yii::t('app', 'Capital Suscrito'),
            'capital_pagado' => Yii::t('app', 'Capital pagado'),
            'certificacion_aporte_id'  => Yii::t('app', 'Certificador de aportes'),
            
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
    public function getCertificacionAporte()
    {
        return $this->hasOne(CertificacionesAportes::className(), ['id' => 'certificacion_aporte_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    
    
     public function getFormAttribs() {
         $persona = empty($this->certificacion_aporte_id) ? '' : CertificacionesAportes::findOne($this->certificacion_aporte_id)->getNombreJuridica();
        if($this->scenario=='principal')
        {
            

            return [
               'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito']],
               'numero_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'capital_pagado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Pagado']],
               'numero_asociacion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_aportacion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_rotativo_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_inversion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
                'certificacion_aporte_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
               'initValueText' => $persona,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['certificaciones-aportes/certificaciones-aportes-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(certificacion_aporte_id) { return certificacion_aporte_id.text; }'),
                'templateSelection' => new JsExpression('function (certificacion_aporte_id) { return certificacion_aporte_id.text; }'),
                ],]],
            ];
        
        }
        return false;
    }
    public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
               }
          $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($certificado)){
               
                return true;   
            }else{
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
     public function Validardenominacion()
    {
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
           $registro=$registromodificacion;
           
           }
           $denominacion=  DenominacionesComerciales::findOne(['documento_registrado_id'=>$registro->id]);
           if(isset($denominacion)){
               if($denominacion->tipo_denominacion!="COOPERATIVA" || $denominacion->cooperativa_capital=="SUPLEMENTARIO"){
                   return false;
                   
               }else{
                   return true;
               }
           }
       }
       return false;
    }
}
