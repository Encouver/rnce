<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.capitales_pagar_accionistas".
 *
 * @property integer $id
 * @property double $saldo_cierre
 * @property string $fecha_corte
 * @property double $saldo_corte
 * @property double $monto_aumento
 * @property double $saldo_aumento
 * @property integer $capital_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class CapitalesPagarAccionistas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.capitales_pagar_accionistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saldo_cierre', 'fecha_corte', 'saldo_corte', 'monto_aumento', 'saldo_aumento', 'capital_id'], 'required'],
            [['saldo_cierre', 'saldo_corte', 'monto_aumento', 'saldo_aumento'], 'number'],
            [['fecha_corte', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['capital_id'], 'integer'],
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
            'saldo_cierre' => Yii::t('app', 'Saldo Cierre'),
            'fecha_corte' => Yii::t('app', 'Fecha Corte'),
            'saldo_corte' => Yii::t('app', 'Saldo Corte'),
            'monto_aumento' => Yii::t('app', 'Monto Aumento'),
            'saldo_aumento' => Yii::t('app', 'Saldo Aumento'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapital()
    {
        return $this->hasOne(Capitales::className(), ['id' => 'capital_id']);
    }
}
