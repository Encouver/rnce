<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use Yii;
/**
/**
 * This is the model class for table "decretos_div_excedentes".
 *
 * @property integer $id
 * @property integer $acta_constitutiva_id
 * @property string $fecha_cierre
 * @property string $utilidad_acumulada
 * @property string $utilidad_decretada
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
 * @property PagosAccionistasDecretos[] $pagosAccionistasDecretos
 */
class DecretosDivExcedentes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decretos_div_excedentes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_cierre', 'utilidad_acumulada', 'utilidad_decretada', 'contratista_id', 'documento_registrado_id'], 'required'],
            [[ 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['fecha_cierre', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['utilidad_acumulada', 'utilidad_decretada'], 'number'],
            [['sys_status'], 'boolean']
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
            'utilidad_acumulada' => Yii::t('app', 'Utilidad Acumulada'),
            'utilidad_decretada' => Yii::t('app', 'Utilidad Decretada'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagosAccionistasDecretos()
    {
        return $this->hasMany(PagosAccionistasDecretos::className(), ['decreto_div_excedente_id' => 'id']);
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
           'utilidad_acumulada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Utilidad Acumulada'],
          'utilidad_decretada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Inserte valor'],'label'=>'Utilidad Decretada'],
         
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
                   if(!$modificacion->decreto_div_excedente){
                       return true;
                   }
                $decreto = DecretosDivExcedentes::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
                    if(isset($decreto)){
               
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
