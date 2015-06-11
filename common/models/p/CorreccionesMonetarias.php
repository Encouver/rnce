<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\Acciones;
use common\models\p\LimitacionesCapitales;
use common\models\p\ActasConstitutivas;
use common\models\p\CertificacionesAportes;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "correcciones_monetarias".
 *
 * @property integer $id
 * @property string $fecha_aumento
 * @property string $valor_accion
 * @property string $variacion_valor
 * @property integer $total_accion
 * @property string $monto_capital_legal
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property integer $certificacion_aporte_id
 * @property string $fecha_informe
 * @property string $valor_accion_comun
 * @property string $variacion_valor_comun
 * @property string $total_accion_comun
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property CertificacionesAportes $certificacionAporte
 * @property Contratistas $contratista
 */
class CorreccionesMonetarias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'correcciones_monetarias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_aumento', 'valor_accion', 'variacion_valor', 'total_accion', 'monto_capital_legal', 'contratista_id', 'documento_registrado_id', 'certificacion_aporte_id', 'fecha_informe'], 'required'],
            [['fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_informe','actual'], 'safe'],
            [['valor_accion', 'variacion_valor', 'monto_capital_legal', 'valor_accion_comun', 'variacion_valor_comun', 'total_accion_comun'], 'number'],
            [['total_accion', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id', 'certificacion_aporte_id'], 'integer'],
            [['sys_status','actual'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_aumento' => Yii::t('app', 'Fecha Aumento'),
            'valor_accion' => Yii::t('app', 'Valor Accion'),
            'variacion_valor' => Yii::t('app', 'Variacion Valor'),
            'total_accion' => Yii::t('app', 'Total Accion'),
            'monto_capital_legal' => Yii::t('app', 'Monto Capital Legal'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'certificacion_aporte_id' => Yii::t('app', 'Certificacion Aporte ID'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
            'valor_accion_comun' => Yii::t('app', 'Valor Accion Comun'),
            'variacion_valor_comun' => Yii::t('app', 'Variacion Valor Comun'),
            'total_accion_comun' => Yii::t('app', 'Total Accion Comun'),
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
        $attributes = [
            'monto_capital_legal'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Monto Capital'],
            'valor_accion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor Accion Preferencial'],
            'variacion_valor'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Variacion del Valor de la Accion Preferencial'],
            'total_accion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Total Accion Preferencial'],
      
            ];
        if($this->Existecomun()){
            $attributes['valor_accion_comun'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor Accion Comun'];
            $attributes['variacion_valor_comun'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Variacion del Valor de la Accion Comun'];
            $attributes['total_accion_comun'] = ['type'=>Form::INPUT_TEXT,'label'=>'Total Acciones Comunes'];
            
        }
        $attributes['fecha_aumento'] = ['type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],];
         $attributes['certificacion_aporte_id'] = ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
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
            ],]];
            $attributes['fecha_informe'] = ['type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],];
        
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
    public function Asignarcorreccion($correccion){
         if(!is_null($correccion->valor_accion_comun)){
                       
                       $this->total_accion=$correccion->total_accion;
                      $this->valor_accion=$correccion->valor_accion;
                      $this->variacion_valor=0;
                       $this->valor_accion_comun=$correccion->valor_accion_comun;
                      $this->variacion_valor_comun=0;
                       $this->total_accion_comun=$correccion->total_accion_comun;
                   
                   return true;
               }else{
                  
                       $this->total_accion=$correccion->total_accion;
                      $this->valor_accion=$correccion->valor_accion;
                      $this->variacion_valor=0;
                   
                 return false; 
               }
     }
      public function Asignarlimitacion($limitacion){
         if(!is_null($limitacion->valor_accion_comun)){
                       
                       $this->total_accion=$limitacion->total_accion;
                      $this->valor_accion=$limitacion->valor_accion;
                      $this->variacion_valor=0;
                       $this->valor_accion_comun=$limitacion->valor_accion_comun;
                      $this->variacion_valor_comun=0;
                       $this->total_accion_comun=$limitacion->total_accion_comun;
                   
                   return true;
               }else{
                  
                       $this->total_accion=$accion->total_accion;
                      $this->valor_accion=$accion->valor_accion;
                      $this->variacion_valor=0;
                   
                 return false; 
               }
     }
     public function Existecomun(){
       
       $accion = Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
       $correccion= CorreccionesMonetarias::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
       $limitacion= LimitacionesCapitales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'no_afecta'=>false,'actual'=>true]);
       if(isset($correccion) || isset($limitacion)){
            $documento_accion= ActivosDocumentosRegistrados::findOne($accion->documento_registrado_id);
            if(isset($correccion)){
                $documento_correccion= ActivosDocumentosRegistrados::findOne($correccion->documento_registrado_id);
                if($documento_correccion->fecha_registro>$documento_accion->fecha_registro){
                    if(isset($limitacion)){
                        $documento_limitacion= ActivosDocumentosRegistrados::findOne($limitacion->documento_registrado_id);
                        if($documento_correccion->fecha_registro>$documento_limitacion->fecha_registro){
                            if($this->Asignarcorreccion($correccion)){
                                return true;
                            }else{
                                return false;
                            }
                        }else{
                            if($this->Asignarlimitacion($limitacion)){
                                return true;
                                }else{
                                  return false;
                                }
                            }
                    }else{
                        if($this->Asignarcorreccion($correccion)){
                            return true;
                        }else{
                            return false;
                        }
                    }
               
                }else{
                    if(isset($limitacion)){
                        $documento_limitacion= ActivosDocumentosRegistrados::findOne($limitacion->documento_registrado_id);
                        if($documento_limitacion->fecha_registro>$documento_accion->fecha_registro){
                            if($this->Asignarlimitacion($limitacion)){
                                return true;
                            }else{
                                return false;
                            }
                        }
                    }
                }
            }else{
                $documento_limitacion= ActivosDocumentosRegistrados::findOne($limitacion->documento_registrado_id);
                    if($documento_limitacion->fecha_registro>$documento_accion->fecha_registro){
                        if($this->Asignarlimitacion($limitacion)){
                            return true;
                        }else{
                            return false;
                        }
                    }
            }
        }
       if(!is_null($accion->numero_comun)){

                      $this->total_accion=$accion->numero_preferencial;
                      $this->valor_accion=$accion->valor_preferencial;
                     $this->variacion_valor=0;
                       $this->valor_accion_comun=$accion->valor_comun;
                      $this->variacion_valor_comun=0;
                       $this->total_accion_comun=$accion->numero_comun;
                   
                   return true;
       }else{

                     $this->total_accion=$accion->numero_preferencial;
                      $this->valor_accion=$accion->valor_preferencial;
                      $this->variacion_valor=0;
            
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
                   if(!$modificacion->coreccion_monetaria){
                       return true;
                   }
              }else{
                   return true;
               }
           
          $correccion = CorreccionesMonetarias::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($correccion)){
               
                return true;   
            }else{
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
    
}
