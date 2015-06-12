<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\DecretosDivExcedentes;
use common\models\p\ModificacionesActas;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use common\models\p\SysNaturalesJuridicas;
use Yii;

/**
 * This is the model class for table "pagos_accionistas_decretos".
 *
 * @property integer $id
 * @property integer $decreto_div_excedente_id
 * @property string $monto_cancelado
 * @property string $fecha
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property string $tipo_pago
 * @property string $numero
 * @property integer $natural_juridica_id
 *
 * @property Contratistas $contratista
 * @property DecretosDivExcedentes $decretoDivExcedente
 * @property SysNaturalesJuridicas $naturalJuridica
 */
class PagosAccionistasDecretos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagos_accionistas_decretos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['decreto_div_excedente_id', 'monto_cancelado', 'fecha', 'contratista_id', 'tipo_pago', 'numero', 'natural_juridica_id','documento_registrado_id'], 'required'],
            [['decreto_div_excedente_id', 'creado_por', 'actualizado_por', 'contratista_id', 'natural_juridica_id','documento_registrado_id'], 'integer'],
            [['monto_cancelado'], 'number'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['tipo_pago'], 'string'],
            [['numero'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'decreto_div_excedente_id' => Yii::t('app', 'Decreto Div Excedente ID'),
            'monto_cancelado' => Yii::t('app', 'Monto Cancelado'),
            'fecha' => Yii::t('app', 'Fecha'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'tipo_pago' => Yii::t('app', 'Tipo Pago'),
            'numero' => Yii::t('app', 'Numero'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
        ];
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
    public function getDecretoDivExcedente()
    {
        return $this->hasOne(DecretosDivExcedentes::className(), ['id' => 'decreto_div_excedente_id']);
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
    public function getNaturalJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridica_id']);
    }
     public function getFormAttribs() {
         $persona = empty($this->natural_juridica_id) ? '' : SysNaturalesJuridicas::findOne($this->natural_juridica_id)->denominacion;
        $pago=[ 'EFECTIVO' => 'EFECTIVO', 'CHEQUE' => 'CHEQUE', 'TRANSFERENCIA' => 'TRANSFERENCIA', ];
     
        return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $persona,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['accionistas-otros/accionistas-otros-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term,sucursal:false}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
        ],]],
    
        'monto_cancelado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'monto']],
   
        'tipo_pago'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$pago,'options'=>['prompt'=>'Seleccione tipo de pago']],
        'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero']],
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
    public function Existeregistro(){   
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro)){
               $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
               if(isset($modificacion)){
                   if(!$modificacion->decreto_div_excedente){
                       return true;
                   }
                $decreto = DecretosDivExcedentes::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
                    if(!isset($decreto)){
               
                        return true;   
                    }else{
                        $this->decreto_div_excedente_id=$decreto->id;
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
