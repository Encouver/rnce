<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_metodos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $modelo_id
 *
 * @property ActivosSysModelos $modelo
 * @property CuentasEInversionesInfoAdicional[] $cuentasEInversionesInfoAdicionals
 */
class ActivosSysMetodos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_metodos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'modelo_id'], 'required'],
            [['modelo_id'], 'integer'],
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
            'modelo_id' => Yii::t('app', 'Modelo ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo()
    {
        return $this->hasOne(ActivosSysModelos::className(), ['id' => 'modelo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasEInversionesInfoAdicionals()
    {
        return $this->hasMany(CuentasEInversionesInfoAdicional::className(), ['sys_metodo_id' => 'id']);
    }
}
