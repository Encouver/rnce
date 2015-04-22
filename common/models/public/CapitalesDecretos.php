<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.capitales_decretos".
 *
 * @property integer $id
 * @property double $numero_accion
 * @property double $valor_accion
 * @property double $saldo_cierre
 * @property string $fecha_aumento
 * @property double $monto_aumento
 * @property integer $capital_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class CapitalesDecretos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.capitales_decretos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_accion', 'valor_accion', 'saldo_cierre', 'fecha_aumento', 'monto_aumento', 'capital_id'], 'required'],
            [['numero_accion', 'valor_accion', 'saldo_cierre', 'monto_aumento'], 'number'],
            [['fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'numero_accion' => Yii::t('app', 'Numero Accion'),
            'valor_accion' => Yii::t('app', 'Valor Accion'),
            'saldo_cierre' => Yii::t('app', 'Saldo Cierre'),
            'fecha_aumento' => Yii::t('app', 'Fecha Aumento'),
            'monto_aumento' => Yii::t('app', 'Monto Aumento'),
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
