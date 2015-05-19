<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_tipos_documentos".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $estado
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosDocumentosRegistrados[] $activosDocumentosRegistrados
 */
class ActivosSysTiposDocumentos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_tipos_documentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['estado', 'sys_status'], 'boolean'],
            [['creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'estado' => Yii::t('app', 'Estado'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosDocumentosRegistrados()
    {
        return $this->hasMany(ActivosDocumentosRegistrados::className(), ['tipo_documento_id' => 'id']);
    }
}
