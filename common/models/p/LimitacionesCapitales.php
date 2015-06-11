<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\Acciones;
use common\models\p\CorreccionesMonetarias;
use common\models\p\ActasConstitutivas;
use common\models\p\CertificacionesAportes;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "limitaciones_capitales".
 *
 * @property integer $id
 * @property boolean $afecta
 * @property string $fecha_cierre
 * @property string $capital_social
 * @property string $total_patrimonio
 * @property double $porcentaje_descapitalizacion
 * @property boolean $supuesto
 * @property string $monto_perdida
 * @property string $fecha_limitacion
 * @property string $capital_social_actualizado
 * @property integer $certificacion_aporte_id
 * @property boolean $reintegro
 * @property string $capital_legal
 * @property string $saldo_perdida
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $fecha_informe
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property boolean $actual
 * @property string $valor_accion
 * @property string $valor_accion_comun
 * @property integer $total_accion
 * @property integer $total_accion_comun
 * @property string $valor_accion_actual
 * @property string $valor_accion_comun_actual
 * @property string $capital_legal_actual
 * @property string $total_capital
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property CertificacionesAportes $certificacionAporte
 * @property Contratistas $contratista
 * @property LimitacionesCapitalesAfectados[] $limitacionesCapitalesAfectados
 */
class LimitacionesCapitales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'limitaciones_capitales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['afecta', 'fecha_cierre', 'capital_social', 'total_patrimonio', 'porcentaje_descapitalizacion', 'supuesto', 'monto_perdida', 'fecha_limitacion', 'capital_social_actualizado', 'certificacion_aporte_id', 'reintegro', 'fecha_informe', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['capital_legal','valor_accion', 'valor_accion_comun', 'valor_accion_actual', 'valor_accion_comun_actual', 'capital_legal_actual', 'total_capital','capital_legal_actualizado'], 'required','on'=>'afectado'],
            [['afecta', 'supuesto', 'reintegro', 'sys_status', 'actual'], 'boolean'],
            [['fecha_cierre', 'fecha_limitacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_informe'], 'safe'],
            [['capital_social', 'total_patrimonio', 'porcentaje_descapitalizacion', 'monto_perdida', 'capital_social_actualizado', 'capital_legal', 'saldo_perdida', 'valor_accion', 'valor_accion_comun', 'valor_accion_actual', 'valor_accion_comun_actual', 'capital_legal_actual', 'total_capital','capital_legal_actualizado'], 'number'],
            [['certificacion_aporte_id', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id', 'total_accion', 'total_accion_comun'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'afecta' => Yii::t('app', 'Afecta'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'capital_social' => Yii::t('app', 'Capital Social'),
            'total_patrimonio' => Yii::t('app', 'Total Patrimonio'),
            'porcentaje_descapitalizacion' => Yii::t('app', 'Porcentaje Descapitalizacion'),
            'supuesto' => Yii::t('app', 'Supuesto'),
            'monto_perdida' => Yii::t('app', 'Monto Perdida'),
            'fecha_limitacion' => Yii::t('app', 'Fecha Aplicaicon de Limitacion'),
            'capital_social_actualizado' => Yii::t('app', 'Capital Social Actualizado'),
            'certificacion_aporte_id' => Yii::t('app', 'Certificacion Aporte ID'),
            'reintegro' => Yii::t('app', 'Reintegro'),
            'capital_legal' => Yii::t('app', 'Capital Legal'),
            'saldo_perdida' => Yii::t('app', 'Saldo Perdida'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'actual' => Yii::t('app', 'Actual'),
            'valor_accion' => Yii::t('app', 'Valor Accion'),
            'valor_accion_comun' => Yii::t('app', 'Valor Accion Comun'),
            'total_accion' => Yii::t('app', 'Total Accion'),
            'total_accion_comun' => Yii::t('app', 'Total Accion Comun'),
            'valor_accion_actual' => Yii::t('app', 'Valor Accion Actual'),
            'valor_accion_comun_actual' => Yii::t('app', 'Valor Accion Comun Actual'),
            'capital_legal_actual' => Yii::t('app', 'Capital Legal Actual'),
            'total_capital' => Yii::t('app', 'Total Capital'),
            'capital_legal_actualizado' => Yii::t('app', 'Capital Legal Actualizado'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitalesAfectados()
    {
        return $this->hasMany(LimitacionesCapitalesAfectados::className(), ['limitacion_capital_id' => 'id']);
    }
    public function getFormAttribs() {
      if($this->afecta){
         $comun=  $this->Existecomun();
         
            
        }

    $persona = empty($this->certificacion_aporte_id) ? '' : CertificacionesAportes::findOne($this->certificacion_aporte_id)->getNombreJuridica();
        $attributes = [
            'fecha_cierre'=>['type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],],
            /*'valor_accion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor Accion Preferencial'],
            'variacion_valor'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Variacion del Valor de la Accion Preferencial'],
            'total_accion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Total Accion Preferencial'],
      */
            ];
        if($this->afecta){
            $attributes['capital_legal_actualizado'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Capital Social Legal'];
         
            
        }
        $attributes['capital_social_actualizado'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Capital Social Actualizado'];
         $attributes['total_patrimonio'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Total Patrimonio Actualizado'];
         $attributes['porcentaje_descapitalizacion'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Porcentaje de descapitalizacion'];
         $attributes['supuesto'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Supuesto del Artículo 264 del Código de Comercio'];
        $attributes['monto_perdida'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Monto del Déficit o Pérdida Acumulada'];
        if($this->afecta){
            $attributes['capital_legal'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Capital Social Legal una vez aplicada la Limitación'];
            
        }
         $attributes['capital_social'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Capital Social Legal una vez aplicada la Limitación'];
         if($this->afecta){
       
             $attributes['valor_accion'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor Unitario de las Acciones preferenciales una vez aplicada la Limitación'];
             if($comun){
             $attributes['valor_accion_comun'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor Unitario de las Acciones comunes una vez aplicada la Limitación'];
            
             }
             $attributes['total_accion'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Total Número de Acciones / Participaciones preferenciales'];
             if($comun){
             $attributes['total_accion_comun'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Total Número de Acciones / Participaciones comunes'];
             } 
             $attributes['valor_accion_actual'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor actual de las Acciones / Participaciones preferenciales'];
            if($comun){
             $attributes['valor_accion_comun_actual'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Valor actual de las Acciones / Participaciones comunes'];
             
             }
             $attributes['total_capital'] = ['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor accion'],'label'=>'Total Capital Social una vez aplicada la Limitación'];
        }
        $attributes['fecha_limitacion'] = ['type'=>Form::INPUT_WIDGET, 
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
                       
                       //$this->total_accion=$correccion->total_accion;
                      $this->valor_accion_actual=$correccion->valor_accion;
                    
                       $this->valor_accion_comun_actual=$correccion->valor_accion_comun;

                       //$this->total_accion_comun=$correccion->total_accion_comun;
                   
                   return true;
               }else{
                  
                       $this->valor_accion_actual=$correccion->valor_accion;
                    
                   
                 return false; 
               }
     }
      public function Asignarlimitacion($limitacion){
         if(!is_null($limitacion->valor_accion_comun)){
                       
                       //$this->total_accion=$limitacion->total_accion;
                      $this->valor_accion_actual=$limitacion->valor_accion;
                     
                       $this->valor_accion_comun_actual=$limitacion->valor_accion_comun;
                   
                      // $this->total_accion_comun=$limitacion->total_accion_comun;
                   
                   return true;
               }else{
                  
                    
                      $this->valor_accion_actual=$limitacion->valor_accion;

                   
                 return false; 
               }
     }
     public function Existecomun(){
       
       $accion = Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
       $correccion= CorreccionesMonetarias::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
       $limitacion= LimitacionesCapitales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'afecta'=>true,'actual'=>true]);
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
            $this->valor_accion_actual=$accion->valor_preferencial;
                     
                       $this->valor_accion_comun_actual=$accion->valor_comun;
                   
                
                   return true;
       }else{
            $this->valor_accion_comun_actual=$accion->valor_comun;
            $this->valor_accion_actual=$accion->valor_preferencial;
            
            
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
                   if(!$modificacion->limitacion_capital && !$modificacion->limitacion_capital_afectado){
                       return true;
                   }else{
                       if($modificacion->limitacion_capital){
                           $this->afecta=false;
                       }else{
                           $this->afecta=true;
                       }
                   }
                $limitacion = LimitacionesCapitales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
                    if(isset($correccion)){
               
                        return true;   
                    }else{
                        $this->documento_registrado_id=$registro->id;
                    }
                   
                }else{
                   return true;
                }

               
            
        }else{
            return true;
        }
    }
}
