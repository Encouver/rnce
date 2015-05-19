<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.hh_concepto".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property CuentasHhPasivoLaboral[] $cuentasHhPasivoLaborals
 */
class CuentasHhConcepto extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.hh_concepto';
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
    public function getCuentasHhPasivoLaborals()
    {
        return $this->hasMany(CuentasHhPasivoLaboral::className(), ['hh_concepto_id' => 'id']);
    }
}
