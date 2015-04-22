<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_cuentas".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $modelos
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property NotasRevelatoriasCuentas[] $notasRevelatoriasCuentas
 */
class SysCuentas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_cuentas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'modelos'], 'required'],
            [['modelos'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
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
            'modelos' => Yii::t('app', 'Modelos'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasRevelatoriasCuentas()
    {
        return $this->hasMany(NotasRevelatoriasCuentas::className(), ['sys_cuenta_id' => 'id']);
    }
}
