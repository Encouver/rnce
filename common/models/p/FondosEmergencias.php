<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use Yii;
/**
 * This is the model class for table "fondos_emergencias".
 *
 * @property integer $id
 * @property string $fecha_cierre
 * @property string $saldo_fondo
 * @property string $monto_perdida
 * @property string $monto_utilizado
 * @property string $monto_asociados
 * @property boolean $corto_plazo
 * @property integer $numero_plazo
 * @property boolean $interes
 * @property double $tasa_interes
 * @property string $saldo_fondo_actual
 * @property string $monto_actual
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class FondosEmergencias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fondos_emergencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_cierre', 'saldo_fondo', 'monto_perdida', 'monto_utilizado',  'saldo_fondo_actual', 'monto_actual', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['fecha_cierre', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['saldo_fondo', 'monto_perdida', 'monto_utilizado', 'monto_asociados', 'tasa_interes', 'saldo_fondo_actual', 'monto_actual'], 'number'],
            [['corto_plazo', 'interes', 'sys_status'], 'boolean'],
             ['monto_asociados', 'required', 'when' => function ($model) {
                return $model->monto_actual >0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#fondosemergencias-monto_actual').val()>0;
            }"],
           ['corto_plazo', 'required', 'when' => function ($model) {
                return $model->monto_actual >0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#fondosemergencias-monto_actual').val()>0;
            }"],
             ['interes', 'required', 'when' => function ($model) {
                return $model->monto_actual >0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#fondosemergencias-monto_actual').val()>0;
            }"],
             ['numero_plazo', 'required', 'when' => function ($model) {
                return $model->monto_actual >0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#fondosemergencias-monto_actual').val()>0;
            }"],
            ['tasa_interes', 'required', 'when' => function ($model) {
                return ($model->monto_actual >0 && $model->interes);
            }, 'whenClient' => "function (attribute, value) {
                return ($('#fondosemergencias-monto_actual').val()>0 && $('#fondosemergencias-monto_actual').val()==true);
            }"],
            ['monto_actual', 'asignarvalor'],
            ['interes', 'asignartasa'],
            [['numero_plazo', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer']
        ];
    }
    public function Asignarvalor($attribute){
        if($this->monto_actual<=0){
          $this->numero_plazo=null;
          $this->interes=null;
          $this->tasa_interes=null;
          $this->corto_plazo=null;
          $this->monto_asociados=null;
          
          }
    }
     public function Asignartasa($attribute){
        if(!$this->interes){
          $this->tasa_interes=null;
          
          }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'saldo_fondo' => Yii::t('app', 'Saldo Fondo'),
            'monto_perdida' => Yii::t('app', 'Monto Perdida'),
            'monto_utilizado' => Yii::t('app', 'Monto Utilizado'),
            'monto_asociados' => Yii::t('app', 'Monto Asociados'),
            'corto_plazo' => Yii::t('app', 'Corto Plazo'),
            'numero_plazo' => Yii::t('app', 'Numero Plazo'),
            'interes' => Yii::t('app', 'Interes'),
            'tasa_interes' => Yii::t('app', 'Tasa Interes'),
            'saldo_fondo_actual' => Yii::t('app', 'Saldo Fondo Actual'),
            'monto_actual' => Yii::t('app', 'Monto Actual'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
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
      

   
        return [
            
            'fecha_cierre'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
            
            ],
           'saldo_fondo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Saldo del Fondo de Emergencia al Cierre del Ejercicio Económico anterior'],
          'monto_perdida'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Monto del Déficit o Pérdida Acumulada'],
           'monto_utilizado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Monto utilizado del Fondo de Emergencia'],
           'saldo_fondo_actual'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Saldo del Fondo de Emergencia una vez utilizado'],
           'monto_actual'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Monto del Déficit o Pérdida Acumulada una vez utilizado el Fondo de Emergencia'],
           'monto_asociados'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Monto Aporte de Asociados'],
          'corto_plazo'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Corto Plazo', false=>'Largo Plazo'], 
            'options'=>['inline'=>true],
             'label'=>'Plazo'
            ],
            'numero_plazo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Tiempo de plazo'],
             'interes'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Si', false=>'No'], 
            'options'=>['inline'=>true]
            ],
            'tasa_interes'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Tasa de interes'],
      
            ];

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
                   if(!$modificacion->fondo_emergencia){
                       return true;
                   }
                $fondo = FondosEmergencias::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
                    if(isset($fondo)){
               
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
