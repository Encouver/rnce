<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.d2_otros_tributos_pag".
 *
 * @property integer $id
 * @property string $saldo_pah
 * @property string $credito_fiscal
 * @property string $monto
 * @property string $debito_fiscal
 * @property string $debito_fiscal_no
 * @property string $importe_pagado
 * @property string $saldo_cierre
 */
class CuentasD2OtrosTributosPag extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.d2_otros_tributos_pag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saldo_pah', 'credito_fiscal', 'monto', 'debito_fiscal', 'debito_fiscal_no', 'importe_pagado'], 'required'],
            [['saldo_pah', 'credito_fiscal', 'monto', 'debito_fiscal', 'debito_fiscal_no', 'importe_pagado', 'saldo_cierre'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'saldo_pah' => Yii::t('app', 'Saldo Pah'),
            'credito_fiscal' => Yii::t('app', 'Credito Fiscal'),
            'monto' => Yii::t('app', 'Monto'),
            'debito_fiscal' => Yii::t('app', 'Debito Fiscal'),
            'debito_fiscal_no' => Yii::t('app', 'Debito Fiscal No'),
            'importe_pagado' => Yii::t('app', 'Importe Pagado'),
            'saldo_cierre' => Yii::t('app', 'Saldo Cierre'),
        ];
    }
}
