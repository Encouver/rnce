<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\ActasConstitutivas;
use common\models\p\DenominacionesComerciales;
use Yii;
/**
 * This is the model class for table "acciones_disminuidas".
 *
 * @property integer $id
 * @property string $justificacion
 * @property string $tipo_disminucion
 * @property string $valor_comun
 * @property string $valor_preferencial
 * @property integer $numero_comun
 * @property integer $numero_preferencial
 * @property integer $acta_constitutiva_id
 * @property string $valor_comun_actual
 * @property string $valor_preferencial_actual
 * @property integer $numero_comun_actual
 * @property integer $numero_preferencial_actual
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
 * @property ActasConstitutivas $actaConstitutiva
 * @property Contratistas $contratista
 */
class AccionesDisminuidas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acciones_disminuidas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['justificacion', 'tipo_disminucion', 'capital_social', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['justificacion', 'tipo_disminucion'], 'string'],
            [['valor_preferencial_actual', 'valor_preferencial'], 'required','on'=>'valor'],
            [['numero_preferencial_actual', 'numero_preferencial'], 'required','on'=>'cantidad'],
            [['valor_comun', 'valor_preferencial', 'valor_comun_actual', 'valor_preferencial_actual', 'capital_social'], 'number'],
            [['numero_comun', 'numero_preferencial', 'numero_comun_actual', 'numero_preferencial_actual', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['sys_status', 'actual'], 'boolean'],
            [['capital_social'], 'validarcapital'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }
    public function validarcapital($attribute){
        $comun=$this->Existecomun();
        if($this->scenario=='valor'){
            $capital=$this->numero_preferencial_actual*$this->valor_preferencial;
            if($comun){
               $capital=$capital+($this->numero_comun_actual*$this->valor_comun);
            }
        }else{
            $capital=$this->numero_preferencial*$this->valor_preferencial_actual;
            if($comun){
               $capital=$capital+($this->numero_comu*$this->valor_comun_actual);
            }
        }
        if($capital>=$this->capital_social){
            $this->addError($attribute,'El capital social no refleja una disminucion del capital: '.$capital.' de '.$this->capital_social);
        }else{
             if($this->scenario=='valor'){
                 $this->numero_comun= $this->numero_comun_actual;
                 $this->numero_preferencial= $this->numero_preferencial_actual;
             }else{
                 $this->valor_comun= $this->valor_comun_actual;
                 $this->valor_preferencial= $this->valor_preferencial_actual;
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
            'valor_comun' => Yii::t('app', 'Valor Comun'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'numero_comun' => Yii::t('app', 'Numero Comun'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'valor_comun_actual' => Yii::t('app', 'Valor Comun Actual'),
            'valor_preferencial_actual' => Yii::t('app', 'Valor Preferencial Actual'),
            'numero_comun_actual' => Yii::t('app', 'Numero Comun Actual'),
            'numero_preferencial_actual' => Yii::t('app', 'Numero Preferencial Actual'),
            'capital_social' => Yii::t('app', 'Capital Social'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
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
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    
     public function getFormAttribs() {
   
         $comun= $this->Existecomun();
          $attributes = [
            'justificacion'=>['type'=>Form::INPUT_TEXTAREA,'options'=>['placeholder'=>'Valor accion'],'label'=>'Justificacion'],
              
            ];
            if($this->scenario=='valor'){
                 $attributes['valor_preferencial_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion preferencial actual'];
              }else{
                  $attributes['numero_preferencial_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion preferencial actual'];
              }
        if($comun){
            if($this->scenario=='valor'){
                 $attributes['valor_comun_actual'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion comun actual'];
              }else{
                  $attributes['numero_comun_actual'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion comun actual'];
              }
            
         
            
        }
         if($this->scenario=='valor'){
                  $attributes['valor_preferencial'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion preferencial una vez aplicada la disminucion'];
              }else{
                  $attributes['numero_preferencial'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion preferencial una vez aplicada la disminucion'];
              }
       
         if($comun){
             if($this->scenario=='valor'){
                $attributes['valor_comun'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor accion comun una vez aplicada la disminucion'];
              }else{
                $attributes['numero_comun'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion comun una vez aplicada la disminucion'];
              }
            
         
            
            }
            if($this->scenario=='valor'){
                $attributes['numero_comun_actual'] = ['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['numero_preferencial_actual'] = ['type'=>Form::INPUT_HIDDEN,'label'=>false];
            }else{
                $attributes['valor_comun_actual'] = ['type'=>Form::INPUT_HIDDEN,'label'=>false];
                $attributes['valor_preferencial_actual'] = ['type'=>Form::INPUT_HIDDEN,'label'=>false];
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
                            $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$modificacion->documento_registrado_id,'tipo_accion'=>'PAGO_CAPITAL']);
                            if(isset($accion)){
                                if(($accion->capital + $acta->capital_pagado)==$acta->capital_suscrito){
                                    return true;
                                }
                                
                            }
                        }
                         
                     }
                 }   
                      
        }
        return false;       
       
    }
   public function Existecomun($actualizar=true){
       
       $accion = Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
       $accion_actual=Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_accion'=>'ACTUAL']);
       if(isset($accion_actual)){
            $accion =$accion_actual;
       }
       if($actualizar){
           $this->capital_social=$accion->capital;
                $this->valor_preferencial_actual=$accion->valor_preferencial;
                $this->valor_comun_actual=$accion->valor_comun;
                $this->numero_preferencial_actual=$accion->numero_preferencial;
                $this->numero_comun_actual=$accion->numero_comun;
             
           
           }
       if(!is_null($accion->numero_comun)){
           
           return true;
       }
       return false;
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
                    $disminucion= AccionesDisminuidas::findOne(['documento_registrado_id'=>$registro->id]);
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
               if($denominacion->tipo_denominacion=="COOPERATIVA"){
                   return false;
                   
               }else{
                   return true;
               }
           }
       }
       return false;
    }
    
}
