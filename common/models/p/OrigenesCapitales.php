<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\DenominacionesComerciales;
use common\models\p\ActasConstitutivas;
use common\models\a\ActivosBienes;
use common\models\p\Certificados;
use common\models\p\AportesCapitalizar;
use common\models\p\FondosEmergencias;
use common\models\p\Suplementarios;
use common\models\p\Acciones;
use kartik\widgets\Select2;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "origenes_capitales".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property integer $banco_contratista_id
 * @property string $monto
 * @property string $fecha
 * @property string $saldo_cierre_anterior
 * @property string $saldo_corte
 * @property string $fecha_corte
 * @property string $monto_aumento
 * @property string $saldo_aumento
 * @property integer $numero_accion
 * @property string $valor_acciones
 * @property string $saldo_cierre_ajustado
 * @property string $fecha_aumento
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_origen
 * @property integer $numero_transaccion
 * @property boolean $efectivo
 * @property boolean $banco
 * @property boolean $bien
 * @property boolean $cuenta_pagar
 * @property boolean $decreto
 * @property boolean $principal
 *
 * @property ActivosBienes $bien0
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property BancosContratistas $bancoContratista
 * @property Contratistas $contratista
 */
class OrigenesCapitales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'origenes_capitales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'banco_contratista_id', 'numero_accion', 'contratista_id', 'documento_registrado_id', 'creado_por', 'actualizado_por', 'numero_transaccion'], 'integer'],
            [['contratista_id', 'documento_registrado_id','tipo_origen','principal'], 'required'],
            [['tipo_origen','tipo_cuenta'], 'string'],
            ['monto', 'validarmonto'],
            ['monto_aumento', 'validarmontoaumento'],
            [['monto','fecha'], 'required', 'on' => 'efectivo'],
            [['monto','banco_contratista_id','numero_transaccion'], 'required', 'on' => 'banco'],
            [['numero_accion','valor_acciones','saldo_cierre_ajustado','fecha_aumento','monto_aumento'], 'required', 'on' => 'decreto'],
            [['saldo_cierre_anterior','saldo_corte','fecha_corte','monto_aumento', 'saldo_aumento','tipo_cuenta'], 'required', 'on' => 'cuentapagar'],
            [['monto','bien_id'], 'required', 'on' => 'bien'],
            [['monto', 'saldo_cierre_anterior', 'saldo_corte', 'monto_aumento', 'saldo_aumento', 'valor_acciones', 'saldo_cierre_ajustado'], 'number'],
            [['fecha', 'fecha_corte', 'fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status', 'efectivo', 'banco', 'bien', 'cuenta_pagar', 'decreto','principal'], 'boolean'],
            [['efectivo', 'banco', 'bien', 'cuenta_pagar', 'decreto'],'default','value'=>false],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'banco_contratista_id' => Yii::t('app', 'Banco Contratista ID'),
            'monto' => Yii::t('app', 'Monto'),
            'fecha' => Yii::t('app', 'Fecha'),
            'saldo_cierre_anterior' => Yii::t('app', 'Saldo Cierre Anterior'),
            'saldo_corte' => Yii::t('app', 'Saldo Corte'),
            'fecha_corte' => Yii::t('app', 'Fecha Corte'),
            'monto_aumento' => Yii::t('app', 'Monto Aumento'),
            'saldo_aumento' => Yii::t('app', 'Saldo Aumento'),
            'numero_accion' => Yii::t('app', 'Numero Accion'),
            'valor_acciones' => Yii::t('app', 'Valor Acciones'),
            'saldo_cierre_ajustado' => Yii::t('app', 'Saldo Cierre Ajustado'),
            'fecha_aumento' => Yii::t('app', 'Fecha Aumento'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'numero_transaccion' => Yii::t('app', 'Numero Transaccion'),
            'efectivo' => Yii::t('app', 'Efectivo'),
            'banco' => Yii::t('app', 'Banco'),
            'bien' => Yii::t('app', 'Bien'),
            'cuenta_pagar' => Yii::t('app', 'Cuenta Pagar'),
            'decreto' => Yii::t('app', 'Decreto'),
            'tipo_origen' => Yii::t('app', 'Tipo Origen'),
            'principal' => Yii::t('app', 'Principal'),
            'tipo_cuenta' => Yii::t('app', 'Tipo Cuenta'),
        ];
    }
    public function validarmonto($attribute){
        
        $monto_pagado=0;
        if($this->principal){
       // $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->id, 'tipo_documento_id'=>1]);

         $denominacion_comercial= DenominacionesComerciales::findOne(['contratista_id'=>Yii::$app->user->identity->id,'documento_registrado_id'=>$this->documento_registrado_id]);
            if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
            
             $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'suscrito'=>false]);
             
             $monto_pagado = $accion->capital;
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
           
             $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'suscrito'=>false]);
             $monto_pagado = $certificado->capital;
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
             $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id ,'documento_registrado_id'=>$this->documento_registrado_id,'suscrito'=>false]);
             $monto_pagado = $suplementario->capital;
         }
          //$monto_actual= $this->sumarmonto()+$this->monto;
          
         
          
        }else{
            $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
            if($this->tipo_origen!='APORTE_CAPITALIZAR' && $this->tipo_origen!='FONDO_EMERGENCIA'){
                $denominacion_comercial= DenominacionesComerciales::findOne($acta->denominacion_comercial_id);
                if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
            
                    $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'tipo_accion'=>$this->tipo_origen]);
                    if(isset( $accion)){
                        $monto_pagado = $accion->capital;
                    }
            
                }
                if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
           
                    $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'tipo_certificado'=>$this->tipo_origen]);
                    if(isset($certificado)){
                         $monto_pagado = $certificado->capital;
                    }
            
                }
                if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
                    $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id ,'documento_registrado_id'=>$this->documento_registrado_id,'tipo_suplementario'=>$this->tipo_origen]);
                    if(isset($suplementario)){
                        $monto_pagado = $suplementario->capital;
                    }
            
                }
            }else{
                
                $fondo= FondosEmergencias::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id]);
                    if(isset($fondo)){
                        if(!is_null($fondo->monto_asociados)){
                             $monto_pagado = $fondo->monto_asociados;
                        }
                       
                    }
            }
                  
            
        }
        $monto_actual= $this->sumarmonto()+$this->monto;
         if($monto_actual>$monto_pagado){
               $this->addError($attribute,'Monto excedente');
          }else{
              if($this->monto<1){
               $this->addError($attribute,'Monto debe ser mayor igual a 1');
                }
          }
          
    }
    public function validarmontoaumento($attribute){
        
        $monto_pagado=0;
         if($this->tipo_origen!='APORTE_CAPITALIZAR'  && $this->tipo_origen!='FONDO_EMERGENCIA'){
            $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
            $denominacion_comercial= DenominacionesComerciales::findOne($acta->denominacion_comercial_id);
            if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
            
             $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'tipo_accion'=>$this->tipo_origen]);
             if(isset( $accion)){
                  $monto_pagado = $accion->capital;
             }
            
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
           
             $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'tipo_certificado'=>$this->tipo_origen]);
             if(isset($certificado)){
                  $monto_pagado = $certificado->capital;
             }
            
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
             $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id ,'documento_registrado_id'=>$this->documento_registrado_id,'tipo_suplementario'=>$this->tipo_origen]);
              if(isset($suplementario)){
                   $monto_pagado = $suplementario->capital;
             }
            
         }
         }else{
                if($this->tipo_origen=='APORTE_CAPITALIZAR'){
                    $aporte= AportesCapitalizar::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id]);
                        if(isset($aporte)){
                            $monto_pagado = $aporte->monto_aporte;
                        }
                }else{
                     $fondo= FondosEmergencias::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id]);
                    if(isset($fondo)){
                        if(!is_null($fondo->monto_asociados)){
                             $monto_pagado = $fondo->monto_asociados;
                        }
                       
                    }
                }
            }
                  
            
        
        $monto_actual= $this->sumarmonto()+$this->monto_aumento;
         if($monto_actual>$monto_pagado){
               $this->addError($attribute,'Monto excedente');
          }else{
              if($this->monto_aumento<1){
               $this->addError($attribute,'Monto aumento debe ser mayor igual a 1');
                }
          }
    }
    
    public function sumarmonto($sum=true)
    {
        $suma=0;
        
        
       // $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
        if($this->principal){
             $capitales= OrigenesCapitales::findAll(['contratista_id'=>Yii::$app->user->identity->id, 'documento_registrado_id'=>$this->documento_registrado_id]);  
        }else{
            $capitales= OrigenesCapitales::findAll(['contratista_id'=>Yii::$app->user->identity->id, 'documento_registrado_id'=>$this->documento_registrado_id,'tipo_origen'=>$this->tipo_origen]);
        }
      
      
        if(isset($capitales)){
             foreach ($capitales as $capital) {
                 if(!is_null($capital->monto)){
                $suma=$suma+$capital->monto;
                 }else{
                      $suma=$suma+$capital->monto_aumento;
                 }
            }
           if(!$this->isNewRecord && $sum){
              $capital= OrigenesCapitales::findOne($this->id);
              if(!is_null($capital->monto)){
                 $suma= $suma-$capital->monto;
                 }else{
                      $suma=$suma-$capital->monto_aumento;
                 }
           }
        }
       
        
        return $suma;
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien0()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
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
    public function getBancoContratista()
    {
        return $this->hasOne(BancosContratistas::className(), ['id' => 'banco_contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    public function getFormAttribs($id){
         $modificacion = [];
          $modificaciones= ModificacionesActas::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
          if(isset($modificaciones)){
                if($modificaciones->pago_capital && $id!='decreto'){
                  $modificacion = array_merge ( $modificacion,[['id' => 'PAGO_CAPITAL', 'name' => 'PAGO DE CAPITAL']] );
                   }
                if($modificaciones->fondo_emergencia && $id!='decreto'){
                  $modificacion = array_merge ( $modificacion,[['id' => 'FONDO_EMERGENCIA', 'name' => 'FONDO DE EMERGENCIA']] );
                }
                if($modificaciones->aporte_capitalizar && $id!='decreto' && $id!='cuentapagar'){
                  $modificacion = array_merge ( $modificacion,[['id' => 'APORTE_CAPITALIZAR', 'name' => 'APORTE POR CAPITALIZAR']] );
                   }
                if($modificaciones->aumento_capital){
                  $modificacion = array_merge ( $modificacion,[['id' => 'AUMENTO_CAPITAL', 'name' => 'AUMENTO DE CAPITAL']] );
                   }
          }
        if($id=='efectivo' && $this->principal)
        {
           
            return [
                
                'monto'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto Efectivo'],
                'fecha'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
                
            ];

        }
         
        if($id=='banco' && $this->principal){
            $ban = BancosContratistas::find()->all();
            $array = array();
              foreach ($ban as $banco) {
                
                $array[] = ['id' => $banco->id, 'nombre' => $banco->banco->nombre.' '.$banco->num_cuenta];
            }


           return [
                'banco_contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map($array, 'id', 'nombre'), 'label'=>'Banco Numero de Cuenta','options'=>['prompt'=>'Seleccione una cuenta']],
                'numero_transaccion'=>['type'=>Form::INPUT_TEXT,'label'=>'Numero de transaccion'],
                'fecha'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
                'monto'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto transaccion'],
            ];
        }
  
        if($id=='bien' && $this->principal){
           return [
                'bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['activos-bienes/bienes-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(bien_id) { return bien_id.text; }'),
                'templateSelection' => new JsExpression('function (bien_id) { return bien_id.text; }'),
                ],]],
               
               'monto'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto bien'],
            ];
        }
        if($id=='efectivo')
            
        {
           
            return [
                'tipo_origen'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($modificacion, 'id', 'name'),'options'=>['prompt'=>'Seleccione tipo origen']],
                'monto'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto Efectivo'],
                'fecha'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
                
            ];

        }
         if($id=='banco'){
            $ban = BancosContratistas::find()->all();
            $array = array();
              foreach ($ban as $banco) {
                
                $array[] = ['id' => $banco->id, 'nombre' => $banco->banco->nombre.' '.$banco->num_cuenta];
            }


           return [
               'tipo_origen'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($modificacion, 'id', 'name'),'options'=>['prompt'=>'Seleccione tipo origen']],
                'banco_contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map($array, 'id', 'nombre'), 'label'=>'Banco Numero de Cuenta','options'=>['prompt'=>'Seleccione una cuenta']],
                'numero_transaccion'=>['type'=>Form::INPUT_TEXT,'label'=>'Numero de transaccion'],
                'fecha'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
                'monto'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto transaccion'],
            ];
        }
        if($id=='bien'){
           return [
               'tipo_origen'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($modificacion, 'id', 'name'),'options'=>['prompt'=>'Seleccione tipo origen']],
                'bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['activos-bienes/bienes-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(bien_id) { return bien_id.text; }'),
                'templateSelection' => new JsExpression('function (bien_id) { return bien_id.text; }'),
                ],]],
               
               'monto'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto bien'],
            ];
        }
        if($id=='cuentapagar')
            
        {
           
            return [
                'tipo_origen'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($modificacion, 'id', 'name'),'options'=>['prompt'=>'Seleccione tipo origen']],
                'tipo_cuenta'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DepDrop',
                'options'=>['pluginOptions'=>[
                'depends'=>['origenescapitales-tipo_origen'],
                'placeholder'=>'Select...',
                'url'=>Url::to(['origenes-capitales/subcat'])
                    ]],
                ],
                'saldo_cierre_anterior'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo al cierre del ejericio anterior'],
                'saldo_corte'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo al corte'],
                'fecha_corte'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
                'monto_aumento'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto del aumento'],
                'saldo_aumento'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo despues del aumento'],
                
            ];

        }
        if($id=='decreto')
            
        {
           
            return [
                'tipo_origen'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($modificacion, 'id', 'name'),'options'=>['prompt'=>'Seleccione tipo origen']],
                'numero_accion'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo al cierre del ejericio anterior'],
                'valor_acciones'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo al corte'],
                'saldo_cierre_ajustado'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo cierre ajustado'],
                'fecha_aumento'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
                'monto_aumento'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto del aumento'],
                
            ];

        }
    }
     public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
               $this->principal=false;
           }else{
               $this->tipo_origen="PRINCIPAL";
               $this->principal=true;
           }
           $this->documento_registrado_id=$registro->id;
           return false;
            
        }else{
            return true;
        }
    }
     public function Validarcapital()
    {
          $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
               
           }
           $denominacion = DenominacionesComerciales::findOne(['documento_registrado_id'=>$registro->id]);
           if(isset($denominacion)){
              $accion= Acciones::findAll(['documento_registrado_id'=>$denominacion->documento_registrado_id]);
              $suplementario= Suplementarios::findAll(['documento_registrado_id'=>$denominacion->documento_registrado_id]);
              $certificado= Certificados::findAll(['documento_registrado_id'=>$denominacion->documento_registrado_id]);
              if(isset($accion) || isset($suplementario) || isset($certificado)){
                  return true;
                  
              }else{
                  
                  return false;
              }
           }
         
       }
         return false;
        
       
    }
    public function aceptarmonto(){
        
        $monto_pagado=0;
         $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
        $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
        if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
               /*$modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
                $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
                $denominacion_comercial= DenominacionesComerciales::findOne($acta->denominacion_comercial_id);
               
               */
               
               
           }
         $denominacion_comercial= DenominacionesComerciales::findOne(['documento_registrado_id'=>$registro->id]);
            if(isset($denominacion_comercial)){
                if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
                    $accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'suscrito'=>false]);
                    if(isset($accion)){
                        $monto_pagado = $accion->capital;
                    }else{
                        return false;
                    }
                    
                }else{
                    if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
           
                         $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->id ,'documento_registrado_id'=>$this->documento_registrado_id,'suscrito'=>false]);
                          if(isset($certificado)){
                       $monto_pagado = $certificado->capital;
                         }else{
                        return false;
                                }
                         
                    }else{
                        $suplementario= Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id ,'documento_registrado_id'=>$this->documento_registrado_id,'suscrito'=>false]);
                       
                         if(isset($suplementario)){
                      $monto_pagado = $suplementario->capital;
                         }else{
                        return false;
                                }
                 
                    }
                }
            }
         
          $monto_actual= $this->sumarmonto();
          
          if($monto_actual<$monto_pagado){
              return true;
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
}
