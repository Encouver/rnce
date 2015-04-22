<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_tasas_divisas".
 *
 * @property integer $id
 * @property integer $sys_divisa_id
 * @property string $tasa
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property SysDivisas $sysDivisa
 */
class SysTasasDivisas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_tasas_divisas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_divisa_id', 'tasa'], 'required'],
            [['sys_divisa_id'], 'integer'],
            [['tasa'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_divisa_id', 'tasa'], 'unique', 'targetAttribute' => ['sys_divisa_id', 'tasa'], 'message' => 'The combination of Sys Divisa ID and Tasa has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_divisa_id' => Yii::t('app', 'Sys Divisa ID'),
            'tasa' => Yii::t('app', 'Tasa'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysDivisa()
    {
        return $this->hasOne(SysDivisas::className(), ['id' => 'sys_divisa_id']);
    }
}
