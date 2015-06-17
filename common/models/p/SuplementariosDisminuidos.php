<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\ActasConstitutivas;
use common\models\p\DenominacionesComerciales;
use Yii;

/**
 * This is the model class for table "suplementarios_disminuidos".
 *
 * @property integer $id
 * @property string $justificacion
 * @property string $tipo_disminucion
 * @property string $valor
 * @property integer $numero
 * @property string $valor_actual
 * @property integer $numero_actual
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
class SuplementariosDisminuidos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suplementarios_disminuidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['justificacion', 'tipo_disminucion', 'capital_social', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['justificacion', 'tipo_disminucion'], 'string'],
            [['valor_actual', 'valor'], 'required','on'=>'valor'],
            [['numero_actual', 'numero'], 'required','on'=>'cantidad'],
            [['valor', 'valor_actual', 'capital_social'], 'number'],
            [['numero', 'numero_actual', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['sys_status', 'actual'], 'boolean'],
            [['capital_social'], 'validarcapital'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }
    public function validarcapital($attribute){
        if($this->scenario=='valor'){
            $capital=$this->numero_actual*$this->valor;
           
        }else{
            $capital=$this->numero*$this->valor_actual;
           
        }
        if($capital>=$this->capital_social){
            $this->addError($attribute,'El capital social no refleja una disminucion del capital: '.$capital.' de '.$this->capital_social);
        }else{
             if($this->scenario=='valor'){
                 $this->numero= $this->numero_actual;
                 
             }else{
                 $this->valor= $this->valor_actual;
             
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
            'valor' => Yii::t('app', 'Valor'),
            'numero' => Yii::t('app', 'Numero'),
            'valor_actual' => Yii::t('app', 'Valor Actual'),
            'numero_actual' => Yii::t('app', 'Numero Actual'),
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
                $attributes['valor_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor actual'];
                $attributes['valor'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor'];
                $attributes['numero_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
               
            }else{
                  $attributes['numero_actual'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion asociacion actual'];
                  $attributes['numero'] =['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Numero accion inversional'];
                 
                $attributes['valor_actual'] =['type'=>Form::INPUT_HIDDEN,'label'=>false];
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
                            $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$modificacion->documento_registrado_id,'tipo_suplementario'=>'PAGO_CAPITAL']);
                            if(isset($suplementario)){
                                if(($suplementario->capital + $acta->capital_pagado)==$acta->capital_suscrito){
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
       
       $suplementario = Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
       $suplementario_actual=Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_suplementario'=>'ACTUAL']);
       if(isset( $suplementario_actual)){
             $suplementario = $suplementario_actual;
       }
   
                $this->capital_social=$suplementario->capital;
                $this->valor_actual=  $suplementario->valor;
               
                $this->numero_actual= $suplementario->numero;
             
           
       
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
                    $disminucion= SuplementariosDisminuidos::findOne(['documento_registrado_id'=>$registro->id]);
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
               if($denominacion->tipo_denominacion=="COOPERATIVA" && $denominacion->cooperativa_capital=='SUPLEMENTARIO'){
                   return true;
                   
               }
           }
       }
       return false;
    }
}
