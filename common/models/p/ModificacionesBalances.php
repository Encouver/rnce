<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use Yii;
/**
/**
 * This is the model class for table "modificaciones_balances".
 *
 * @property integer $id
 * @property integer $acta_constitutiva_id
 * @property string $fecha_cierre
 * @property boolean $aprobado
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
 * @property ActasConstitutivas $actaConstitutiva
 * @property Contratistas $contratista
 */
class ModificacionesBalances extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modificaciones_balances';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_cierre', 'aprobado', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['fecha_cierre', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['aprobado', 'sys_status'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'aprobado' => Yii::t('app', 'Resultado Discusion'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
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
      

   
        return [
            
            'fecha_cierre'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
            
            ],
           
          'aprobado'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Aprobación de los Balances', false=>'Modificación de los Balances'], 
            'options'=>['inline'=>true],
          
            ],
           
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
                   if(!$modificacion->modificacion_balance){
                       return true;
                   }
                $modificacion = ModificacionesBalances::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
                    if(isset($modificacion)){
               
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
