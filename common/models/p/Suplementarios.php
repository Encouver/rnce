<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\ActasConstitutivas;
use common\models\p\CertificacionesAportes;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use common\models\p\DenominacionesComerciales;
use Yii;
/**
 * This is the model class for table "suplementarios".
 *
 * @property integer $id
 * @property integer $numero
 * @property string $valor
 * @property string $tipo_suplementario
 * @property boolean $suscrito
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $fecha_informe
 * @property string $sys_finalizado_el
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 * @property integer $certificacion_aporte_id
 * @property boolean $actual
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class Suplementarios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $numero_pagada;
    public $capital_pagado;
    public static function tableName()
    {
        return 'suplementarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['suscrito', 'documento_registrado_id','contratista_id','tipo_suplementario'], 'required'],
            [['numero','numero_pagada', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id','certificacion_aporte_id'], 'integer'],
            [['valor','capital','capital_pagado'], 'number'],
            [['tipo_suplementario'], 'string'],
            ['numero_pagada', 'validarnumeropagada'],
            ['numero', 'validarnumero'],
            ['capital', 'validarcapital'],
            ['capital_pagado', 'validarcapitalpagado'],
            ['valor', 'validarvalor'],
            ['total_venta', 'validarventa'],
            [['total_venta','numero','valor'], 'required', 'on' => 'venta'],
            [['capital','numero','fecha_informe','certificacion_aporte_id'], 'required', 'on' => 'pago'],
            [['capital','capital_pagado','numero', 'valor','numero_pagada','fecha_informe','certificacion_aporte_id'], 'required', 'on' => 'aumento'],
            [['capital','capital_pagado','numero', 'valor','numero_pagada','fecha_informe','certificacion_aporte_id'], 'required', 'on' => 'principal'],
            [['suscrito', 'documento_registrado_id', 'contratista_id'], 'required'],
            [['suscrito', 'sys_status','actual'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el','actual','fecha_informe'], 'safe']
        ];
    }
    public function validarcapital($attribute){
         
        if($this->scenario=='principal' || $this->scenario=='aumento'){
               if($this->numero*$this->valor< $this->capital){
                  $this->addError($attribute,'Faltan capital por fraccionar');
              }
       }else{
              if($this->scenario=='pago'){
                  $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
                  if(isset($acta)){
                      //$accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
                      $monto=$acta->capital_suscrito-$acta->capital_pagado;
                      if($this->capital>$monto){
                        $this->addError($attribute,'Monto sobre pasa el capital deudor actual:'.$monto);
                        }else{
                                $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                                if($this->numero*$suplementario->valor<$this->capital){
                                    $this->addError($attribute,'Falta capital por fraccionar el valor actual del certificado suplementario es: '.$suplementario->valor);
                                }
                        }
                      
                  }
              }
          }
          
    }
     public function validarnumero($attribute){
           if($this->scenario=='pago'){
               $suplementario_suscrito= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
               $suplementario_pagado= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>false]);
          if(($this->numero+ $suplementario_pagado->numero)>$suplementario_suscrito->numero){
               $this->addError($attribute,'El numero de certificados suplementarios sobrepasa las certificados suplementarios suscritos:'.$suplementario_suscrito->numero);
          }else{
             if(($this->numero*$suplementario_suscrito->valor) >$this->capital){
                  $this->addError($attribute,'Numero de certificados suplementarios pagados sobrepasa el valor valido');
             }
          }
        }else{
            if($this->scenario=='venta'){
                $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->numero>$suplementario->numero){
                    $this->addError($attribute,'Numero de certificados suplementarios invalido:'.$this->numero.' de '.$suplementario->numero);
                    }
            }
        }

    }
   
      public function validarnumeropagada($attribute){
          if($this->numero_pagada>$this->numero){
               $this->addError($attribute,'Numero certificado suplementario pagado invalido');
          }else{
             if($this->numero_pagada * $this->valor >$this->capital_pagado){
                  $this->addError($attribute,'Numero certificado suplementario pagado sobrepasa el valor valido');
             }
          }
    }
    public function validarcapitalpagado($attribute){
          if($this->capital_pagado>$this->capital){
               $this->addError($attribute,'Valor certificado suplementario pagado invalido');
          }else{
              if($this->numero_pagada*$this->valor< $this->capital_pagado){
                  $this->addError($attribute,'Faltan certificado suplementario pagado por fraccionar');
              }
          }
    }
    public function validarvalor($attribute){
        if($this->scenario!='venta'){
          if($this->valor*$this->numero > $this->capital){
               $this->addError($attribute,'Valor certificado suscrito invalida');
          }
        }else{
            $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
            if($this->valor!=$suplementario->valor){
                $this->addError($attribute,'Valor de venta de certificados invalido:'.$this->valor.' de '.$suplementario->valor);
            }
            
            
        }
    }
     public function validarventa($attribute){
       
          if($this->valor*$this->numero !=$this->total_venta){
               $this->addError($attribute,'Calculo erroneo en el total de venta:');
          }
        
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero' => Yii::t('app', 'Numero'),
            'valor' => Yii::t('app', 'Valor'),
            'tipo_suplementario' => Yii::t('app', 'Tipo Suplementario'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'numero_pagada' => Yii::t('app', 'Numero Pagada'),
            'capital' => Yii::t('app', 'Capital Suscrito'),
            'capital_pagado' => Yii::t('app', 'Capital Pagado'),
            'certificacion_aporte_id'  => Yii::t('app', 'Certificador de aportes'),
            'actual'  => Yii::t('app', 'Actual'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
            'total_venta' => Yii::t('app', 'Total Venta'),
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
        if($this->scenario=='principal' || $this->scenario=='aumento')
        {
            

            return [
            'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito']],
               'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios']],
               'valor'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
            'capital_pagado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Pagado']],
               
             'numero_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios']],
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
        if($this->scenario=='pago')
        {
            

            return [
            'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito'],'label'=>'Capital pagado'],
            'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios'],'label'=>'Numero certificados suplementarios pagados'],
              
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
        if($this->scenario=='venta')
        {
            

            return [
            'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito'],'label'=>'Numero de acciones'],
            'valor'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios'],'label'=>'valor'],
            'total_venta'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios'],'label'=>'Precio total venta'], 
           
            ];
        
        }
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
                   if($this->scenario=='pago' && !$modificacion->pago_capital){
                       return true;
                   }
                   if($this->scenario=='aumento' && !$modificacion->aumento_capital){
                       return true;
                   }
                    if($this->scenario=='venta' && !$modificacion->venta_accion){
                       return true;
                   }
              }else{
                   return true;
               }
               }
          $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id,'tipo_suplementario'=>$this->tipo_suplementario]);
           if(isset($suplementario)){
               
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
               if($denominacion->tipo_denominacion!="COOPERATIVA" || $denominacion->cooperativa_capital!="SUPLEMENTARIO"){
                   return false;
                   
               }else{
                   return true;
               }
           }
       }
       return false;
    }
}
