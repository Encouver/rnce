<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_origenes_bienes".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property ActivosBienes[] $activosBienes
 */
class ActivosSysOrigenesBienes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_origenes_bienes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'descripcion'], 'string', 'max' => 255],
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
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosBienes()
    {
        return $this->hasMany(ActivosBienes::className(), ['origen_id' => 'id']);
    }
}
