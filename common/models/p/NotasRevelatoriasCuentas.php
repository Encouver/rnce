<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "notas_revelatorias_cuentas".
 *
 * @property integer $id
 * @property integer $nota_revelatoria_id
 * @property integer $sys_cuenta_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property NotasRevelatorias $notaRevelatoria
 * @property SysCuentas $sysCuenta
 */
class NotasRevelatoriasCuentas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notas_revelatorias_cuentas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota_revelatoria_id', 'sys_cuenta_id'], 'required'],
            [['nota_revelatoria_id', 'sys_cuenta_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nota_revelatoria_id' => Yii::t('app', 'Nota Revelatoria ID'),
            'sys_cuenta_id' => Yii::t('app', 'Sys Cuenta ID'),
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
    public function getNotaRevelatoria()
    {
        return $this->hasOne(NotasRevelatorias::className(), ['id' => 'nota_revelatoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysCuenta()
    {
        return $this->hasOne(SysCuentas::className(), ['id' => 'sys_cuenta_id']);
    }
}
