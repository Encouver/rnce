<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use Yii;

/**
 * This is the model class for table "fondos_reservas".
 *
 * @property integer $id
 * @property string $nombre_fondo
 * @property double $porcentaje
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class FondosReservas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fondos_reservas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_fondo', 'porcentaje', 'documento_registrado_id', 'contratista_id'], 'required'],
            [['porcentaje'], 'number'],
            [['creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre_fondo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre_fondo' => Yii::t('app', 'Nombre Fondo'),
            'porcentaje' => Yii::t('app', 'Porcentaje'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
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
    
    public function getFormAttribs(){
        
       

           return [
                'nombre_fondo'=>['type'=>Form::INPUT_TEXT,'label'=>'Nombre del fondo'],
                'porcentaje'=>['type'=>Form::INPUT_TEXT,'label'=>'Porcentaje'],
            ];
        
    }
     public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
           }
          
                $this->documento_registrado_id=$registro->id;
                return false;
           
        }else{
            return true;
        }
    }
}
