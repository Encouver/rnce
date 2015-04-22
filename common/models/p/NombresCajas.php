<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.nombres_cajas".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $contratistas_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratistas
 */
class NombresCajas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.nombres_cajas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'contratistas_id'], 'required'],
            [['contratistas_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre', 'contratistas_id'], 'unique', 'targetAttribute' => ['nombre', 'contratistas_id'], 'message' => 'The combination of Nombre and Contratistas ID has already been taken.']
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
            'contratistas_id' => Yii::t('app', 'Contratistas ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratistas()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratistas_id']);
    }
}
