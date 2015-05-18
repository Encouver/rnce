<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.d1_d2_beneficiario".
 *
 * @property integer $id
 * @property string $nro_planilla
 * @property string $periodo
 * @property string $monto
 * @property integer $sys_naturales_juridicas_id
 * @property string $tipo_beneficio
 */
class CuentasD1D2Beneficiario extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.d1_d2_beneficiario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nro_planilla', 'periodo', 'monto', 'sys_naturales_juridicas_id', 'tipo_beneficio'], 'required'],
            [['monto'], 'number'],
            [['sys_naturales_juridicas_id'], 'integer'],
            [['nro_planilla', 'tipo_beneficio'], 'string', 'max' => 255],
            [['periodo'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nro_planilla' => Yii::t('app', 'Nro Planilla'),
            'periodo' => Yii::t('app', 'Periodo'),
            'monto' => Yii::t('app', 'Monto'),
            'sys_naturales_juridicas_id' => Yii::t('app', 'Sys Naturales Juridicas ID'),
            'tipo_beneficio' => Yii::t('app', 'Tipo Beneficio'),
        ];
    }
}
