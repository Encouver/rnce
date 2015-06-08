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
 * This is the model class for table "acciones".
 *
 * @property integer $id
 * @property integer $numero_comun
 * @property integer $numero_preferencial
 * @property string $valor_comun
 * @property string $valor_preferencial
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_accion
 * @property boolean $suscrito
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 * @property integer $certificacion_aporte_id
 * @property boolean $actual
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class Acciones extends \common\components\BaseActiveRecord
{
    public $numero_comun_pagada;
    public $capital_pagado;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['suscrito', 'documento_registrado_id','contratista_id','tipo_accion','certificacion_aporte_id'], 'required'],
            [['numero_comun', 'numero_comun_pagada','numero_preferencial', 'documento_registrado_id','contratista_id','certificacion_aporte_id'], 'integer'],
            ['numero_comun_pagada', 'validarnumeropagada'],
             ['numero_comun', 'validarnumerocomun'],
            ['capital', 'validarcapital'],
            ['capital_pagado', 'validarcapitalpagado'],
            ['valor_comun', 'validarvalor'],
            [['valor_comun', 'valor_preferencial','capital'], 'number'],
            [['sys_status', 'suscrito'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el','actual'], 'safe'],
            [['tipo_accion'], 'string'],
            [['capital','numero_comun'], 'required', 'on' => 'pago'],
            [['numero_comun', 'valor_comun','numero_comun_pagada','capital','capital_pagado'], 'required', 'on' => 'principal']
            
        ];
    }
     public function validarcapital($attribute){
         if($this->scenario=='principal'){
              if($this->numero_comun*$this->valor_comun< $this->capital){
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
                                $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                                if($this->numero_comun*$accion->valor_comun<$this->capital){
                                    $this->addError($attribute,'Falta capital por fraccionar el valor actual de la accion es: '.$accion->valor_comun);
                                }
                        }
                      
                  }
              }
          }
          
    }
    public function validarnumerocomun($attribute){
           if($this->scenario=='pago'){
               $accion_suscrita= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                $accion_pagada= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>false]);
          if(($this->numero_comun+$accion_pagada->numero_comun)>$accion_suscrita->numero_comun){
               $this->addError($attribute,'El numero de acciones sobrepasa las acciones o participaciones suscritas:'.$accion_suscrita->numero_comun);
          }else{
             if(($this->numero_comun*$accion_suscrita->valor_comun) >$this->capital){
                  $this->addError($attribute,'Numero de acciones pagada sobrepasa el valor valido');
             }
          }
        }

    }
      public function validarnumeropagada($attribute){
           if($this->scenario=='principal'){
          if($this->numero_comun_pagada>$this->numero_comun){
               $this->addError($attribute,'Numero Accion pagada invalido');
          }else{
             if($this->numero_comun_pagada * $this->valor_comun >$this->capital_pagado){
                  $this->addError($attribute,'Numero Accion pagada sobrepasa el valor valido');
             }
          }
        }

    }
    public function validarcapitalpagado($attribute){
        if($this->scenario=='principal'){
          if($this->capital_pagado>$this->capital){
               $this->addError($attribute,'Valor Capital pagada invalido');
          }else{
              if($this->numero_comun_pagada*$this->valor_comun < $this->capital_pagado){
                  $this->addError($attribute,'Faltan capital pagado por fraccionar');
              }
          }
          }
    }
    public function validarvalor($attribute){
        if($this->scenario=='principal'){
          if($this->valor_comun*$this->numero_comun > $this->capital){
               $this->addError($attribute,'Valor accion suscrita invalida');
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
            'numero_comun' => Yii::t('app', 'Numero Accion o Participacion Suscrita'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'valor_comun' => Yii::t('app', 'Valor Accion o Participacion Suscrita'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_accion' => Yii::t('app', 'Tipo Accion'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'contratista_id' => Yii::t('app', 'COntratista'),
            'numero_comun_pagada' => Yii::t('app', 'Numero Accion o Participacion Pagada'),
            'capital' => Yii::t('app', 'Capital'),
            'capital_pagado' => Yii::t('app', 'Capital Pagado'),
            'actual'  => Yii::t('app', 'Actual'),
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
    if($this->scenario=='principal'){
        return [
            'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito']],
            'numero_comun'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de acciones o participaciones']],
            'valor_comun'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
            'capital_pagado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Pagado']],
            'numero_comun_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de acciones o participaciones']],
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
    if($this->scenario=='pago'){
        return [
            'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital'],'label'=>'Capital a pagar'],
            'numero_comun'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de acciones o participaciones'],'label'=>'Numero de acciones o participaciones a pagar'],
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
              }else{
                   return true;
               }
           }
          $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id,'tipo_accion'=>$this->tipo_accion]);
           if(isset($accion)){
               
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
