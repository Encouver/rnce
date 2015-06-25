<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\ActasConstitutivas;
use common\models\p\DenominacionesComerciales;
use Yii;
/**
 * This is the model class for table "certificados_disminuidos".
 *
 * @property integer $id
 * @property string $justificacion
 * @property string $tipo_disminucion
 * @property string $valor_asociacion
 * @property string $valor_aportacion
 * @property string $valor_rotativo
 * @property string $valor_inversion
 * @property integer $numero_asociacion
 * @property integer $numero_aportacion
 * @property integer $numero_rotativo
 * @property integer $numero_inversion
 * @property string $valor_asociacion_actual
 * @property string $valor_aportacion_actual
 * @property string $valor_rotativo_actual
 * @property string $valor_inversion_actual
 * @property integer $numero_asoacion_actual
 * @property integer $numero_aportacion_actual
 * @property string $numero_rotativo_actual
 * @property string $numero_inversion_actual
 * @property string $capital_social
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property boolean $actual
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class CertificadosDisminuidos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificados_disminuidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['justificacion', 'tipo_disminucion', 'capital_social', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['valor_asociacion_actual','valor_aportacion_actual', 'valor_rotativo_actual', 'valor_inversion_actual','valor_asociacion','valor_aportacion','valor_rotativo','valor_inversion'], 'required','on'=>'valor'],
            [['numero_asociacion_actual', 'numero_aportacion_actual', 'numero_rotativo_actual', 'numero_inversion_actual','numero_asociacion','numero_aportacion','numero_rotativo','numero_inversion'], 'required','on'=>'cantidad'],
            [['justificacion', 'tipo_disminucion'], 'string'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion', 'valor_asociacion_actual', 'valor_aportacion_actual', 'valor_rotativo_actual', 'valor_inversion_actual', 'numero_rotativo_actual', 'numero_inversion_actual', 'capital_social'], 'number'],
            [['numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'numero_asociacion_actual', 'numero_aportacion_actual', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['sys_status', 'actual'], 'boolean'],
            [['capital_social'], 'validarcapital'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }
    public function validarcapital($attribute){
        if($this->scenario=='valor'){
            $capital=$this->numero_asociacion_actual*$this->valor_asociacion + $this->numero_aportacion_actual*$this->valor_aportacion + $this->numero_rotativo_actual*$this->valor_rotativo + $this->numero_inversion_actual*$this->valor_inversion;
           
        }else{
            $capital=$this->numero_asociacion*$this->valor_asociacion_actual + $this->numero_aportacion*$this->valor_aportacion_actual + $this->numero_rotativo*$this->valor_rotativo_actual + $this->numero_inversion*$this->valor_inversion_actual;
           
        }
        if($capital>=$this->capital_social){
            $this->addError($attribute,'El capital social no refleja una disminucion del capital: '.$capital.' de '.$this->capital_social);
        }else{
             if($this->scenario=='valor'){
                 $this->numero_asociacion= $this->numero_asociacion_actual;
                 $this->numero_aportacion= $this->numero_aportacion_actual;
                 $this->numero_rotativo= $this->numero_rotativo_actual;
                 $this->numero_inversion= $this->numero_inversion_actual;
             }else{
                 $this->valor_asociacion= $this->valor_asociacion_actual;
                 $this->valor_aportacion= $this->valor_aportacion_actual;
                 $this->valor_inversion= $this->valor_inversion_actual;
                 $this->valor_rotativo= $this->valor_rotativo_actual;
             }
            $this->capital_social=$capital;
        }
       
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'justificacion' => Yii::t('app', 'Justificacion'),
            'tipo_disminucion' => Yii::t('app', 'Tipo Disminucion'),
            'valor_asociacion' => Yii::t('app', 'Valor Asociacion'),
            'valor_aportacion' => Yii::t('app', 'Valor Aportacion'),
            'valor_rotativo' => Yii::t('app', 'Valor Rotativo'),
            'valor_inversion' => Yii::t('app', 'Valor Inversion'),
            'numero_asociacion' => Yii::t('app', 'Numero Asociacion'),
            'numero_aportacion' => Yii::t('app', 'Numero Aportacion'),
            'numero_rotativo' => Yii::t('app', 'Numero Rotativo'),
            'numero_inversion' => Yii::t('app', 'Numero Inversion'),
            'valor_asociacion_actual' => Yii::t('app', 'Valor Asociacion Actual'),
            'valor_aportacion_actual' => Yii::t('app', 'Valor Aportacion Actual'),
            'valor_rotativo_actual' => Yii::t('app', 'Valor Rotativo Actual'),
            'valor_inversion_actual' => Yii::t('app', 'Valor Inversion Actual'),
            'numero_asociacion_actual' => Yii::t('app', 'Numero Asoacion Actual'),
            'numero_aportacion_actual' => Yii::t('app', 'Numero Aportacion Actual'),
            'numero_rotativo_actual' => Yii::t('app', 'Numero Rotativo Actual'),
            'numero_inversion_actual' => Yii::t('app', 'Numero Inversion Actual'),
            'capital_social' => Yii::t('app', 'Capital Social'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado '),
            'actual' => Yii::t('app', 'Actual'),
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
    public function getFormAttribs() {
   
         $comun= $this->Asignarvalores();
          $attributes = [
            'justificacion'=>['type'=>Form::INPUT_TEXTAREA,'options'=>['placeholder'=>'Valor accion'],'label'=>'Justificacion'],
              
            ];
            if($this->scenario=='valor'){
                $attributes['valor_asociacion_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion asociativa actual'];
                $attributes['valor_aportacion_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion aportacion actual'];
                $attributes['valor_rotativo_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion rotativo actual'];
                $attributes['valor_inversion_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion inversion actual'];
                $attributes['valor_asociacion'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion asociativa'];
                $attributes['valor_aportacion'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion aportacion'];
                $attributes['valor_rotativo'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion rotativo'];
                $attributes['valor_inversion'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion inversion'];
                $attributes['numero_asociacion_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['numero_aportacion_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['numero_rotativo_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['numero_inversion_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
            }else{
                  $attributes['numero_asociacion_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion asociacion actual'];
                  $attributes['numero_aportacion_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion aportacion actual'];
                  $attributes['numero_rotativo_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion rotativo actual'];
                  $attributes['numero_inversion_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion inversion actual'];
                   $attributes['numero_asociacion'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion asociacion'];
                  $attributes['numero_aportacion'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion aportacion'];
                  $attributes['numero_rotativo'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion rotativo'];
                  $attributes['numero_inversion'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion inversional'];
                 $attributes['valor_asociacion_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['valor_aportacion_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['valor_rotativo_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['valor_inversion_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
            }
        
         
        
        $attributes['tipo_disminucion'] = ['type'=>Form::INPUT_HIDDEN,'label'=>false];
        $attributes['capital_social'] = ['type'=>Form::INPUT_HIDDEN,'label'=>false];
        return $attributes;
        
         
     }
     public function Pagocompleto(){
       $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
        if(isset($acta)){
                 if($acta->capital_suscrito==$acta->capital_pagado){
                     return true;
                     
                 }else{
                     $modificacion=$this->Modificacionactual();
                     if(isset($modificacion)){
                        if($modificacion->pago_capital){
                            $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$modificacion->documento_registrado_id,'tipo_certificado'=>'PAGO_CAPITAL']);
                            if(isset($certificado)){
                                if(($certificado->capital + $acta->capital_pagado)==$acta->capital_suscrito){
                                    return true;
                                }
                                
                            }
                        }
                         
                     }
                 }   
                      
        }
        return false;       
       
    }
   public function Asignarvalores(){
       
       $certificado = Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
       $certificado_actual=Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_certificado'=>'ACTUAL']);
       if(isset($certificado_actual)){
            $certificado =$certificado_actual;
       }
   
                $this->capital_social=$certificado->capital;
                $this->valor_asociacion_actual=$certificado->valor_asociacion;
                $this->valor_aportacion_actual=$certificado->valor_aportacion;
                $this->valor_rotativo_actual=$certificado->valor_rotativo;
                $this->valor_inversion_actual=$certificado->valor_inversion;
                $this->numero_asociacion_actual=$certificado->numero_asociacion;
                $this->numero_aportacion_actual=$certificado->numero_aportacion;
                $this->numero_rotativo_actual=$certificado->numero_rotativo;
                $this->numero_inversion_actual=$certificado->numero_inversion;
             
           
       
       return true;
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
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro)){
            $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
            if(isset($modificacion)){
                if($modificacion->disminucion_capital){
                    $disminucion= CertificadosDisminuidos::findOne(['documento_registrado_id'=>$registro->id]);
                    if(isset($disminucion)){
                        return true;
                    }
                    $this->documento_registrado_id=$registro->id;
                    if($this->scenario=="valor"){
                        $this->tipo_disminucion= 'SOBRE EL VALOR';
                    }else{
                        $this->tipo_disminucion= 'SOBRE EL NUMERO';
                    }
                   
                     return false;
                }else{
                    return true;
                }
               
       
            }
        }
            return true;
             
    }
     public function Validardenominacion()
    {
         $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
       if(isset($acta)){
           
           $denominacion=  DenominacionesComerciales::findOne($acta->denominacion_comercial_id);
           if(isset($denominacion)){
               if($denominacion->tipo_denominacion=="COOPERATIVA" && $denominacion->cooperativa_capital!='SUPLEMENTARIO'){
                   return true;
                   
               }
           }
       }
       return false;
    }
}
