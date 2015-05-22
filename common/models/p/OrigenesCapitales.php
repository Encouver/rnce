<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\DenominacionesComerciales;
use common\models\p\Certificados;
use common\models\p\Suplementarios;
use common\models\p\Acciones;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "origenes_capitales".
 *
 * @property integer $id
 * @property string $tipo_origen
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
 * @property string $numero_transaccion
 *
 * @property ActivosBienes $bien
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
            [['tipo_origen', 'monto', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['tipo_origen'], 'string'],
            ['monto', 'validarmonto'],
            [['monto','fecha'], 'required', 'on' => 'EFECTIVO'],
            [['monto','banco_contratista_id','numero_transaccion'], 'required', 'on' => 'EFECTIVO EN BANCO'],
            [['monto','bien_id','fecha'], 'required', 'on' => 'PROPIEDADES PLANTAS Y EQUIPOS'],
            [['bien_id', 'banco_contratista_id', 'numero_accion', 'contratista_id', 'documento_registrado_id', 'creado_por', 'actualizado_por','numero_transaccion'], 'integer'],
            [['monto', 'saldo_cierre_anterior', 'saldo_corte', 'monto_aumento', 'saldo_aumento', 'valor_acciones', 'saldo_cierre_ajustado'], 'number'],
            [['fecha', 'fecha_corte', 'fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean']
        ];
    }
    public function validarmonto($attribute){
        
        $monto_pagado;
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);

         $denominacion_comercial= DenominacionesComerciales::findOne(['contratista_id'=>$usuario->contratista_id]);
            if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
            
             $accion= Acciones::findOne(['contratista_id'=>$usuario->contratista_id ,'documento_registrado_id'=>$registro->id,'suscrito'=>false]);
             $monto_pagado = $accion->valor_comun;
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
           
             $certificado= Certificados::findOne(['contratista_id'=>$usuario->contratista_id ,'documento_registrado_id'=>$registro->id,'suscrito'=>false]);
             $monto_pagado = $certificado->valor_asociacion+$certificado->valor_aportacion+$certificado->valor_rotativo+$certificado->valor_inversion;
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
             $suplementario= Suplementarios::findOne(['contratista_id'=>$usuario->contratista_id ,'documento_registrado_id'=>$registro->id,'suscrito'=>false]);
             $monto_pagado = $suplementario->valor;
         }
          $monto_actual= $this->sumarmonto()+$this->monto;
          
          if($monto_actual>$monto_pagado){
               $this->addError($attribute,'Monto excedente');
          }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_origen' => Yii::t('app', 'Tipo Origen'),
            'bien_id' => Yii::t('app', 'Bien'),
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
        ];
    }
   
    public function sumarmonto()
    {
        $suma=0;
        
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                   
        $capitales= OrigenesCapitales::findAll(['contratista_id'=>$usuario->contratista_id, 'documento_registrado_id'=>$registro->id]);
         foreach ($capitales as $capital) {
                $suma=$suma+$capital->monto;
            }
        
        return $suma;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
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
        
        if($id=='EFECTIVO')
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
        if($id=='EFECTIVO EN BANCO'){
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
}
