<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_divisas".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $codigo
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property SysTasasDivisas[] $sysTasasDivisas
 */
class SysDivisas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_divisas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'codigo'], 'required'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['codigo'], 'string', 'max' => 20],
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
            'codigo' => Yii::t('app', 'Codigo'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysTasasDivisas()
    {
        return $this->hasMany(SysTasasDivisas::className(), ['sys_divisa_id' => 'id']);
    }
}
