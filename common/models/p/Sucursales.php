<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use Yii;

/**
 * This is the model class for table "sucursales".
 *
 * @property integer $direccion_id
 * @property integer $contratista_id
 * @property integer $id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $natural_juridica_id
 * @property integer $documento_registrado_id
 *
 * @property Contratistas $contratista
 * @property Direcciones $direccion
 * @property SysNaturalesJuridicas $naturalJuridica
 */
class Sucursales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sucursales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direccion_id', 'contratista_id', 'natural_juridica_id','documento_registrado_id'], 'required'],
            [['direccion_id', 'contratista_id', 'creado_por', 'actualizado_por', 'natural_juridica_id','documento_registrado_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'direccion_id' => Yii::t('app', 'Direccion'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'id' => Yii::t('app', 'ID'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica'),
            'documento_registrado_id' => Yii::t('app', 'Documento Refistrado'),
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
    public function getDireccion()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'direccion_id']);
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
