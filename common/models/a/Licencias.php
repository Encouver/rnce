<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.licencias".
 *
 * @property integer $id
 * @property integer $activo_intangible_id
 * @property string $numero
 * @property string $fecha_adquisicion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosIntangibles $activoIntangible
 */
class Licencias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.licencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activo_intangible_id'], 'required'],
            [['activo_intangible_id'], 'integer'],
            [['fecha_adquisicion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['numero'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activo_intangible_id' => Yii::t('app', 'Activo Intangible ID'),
            'numero' => Yii::t('app', 'Numero'),
            'fecha_adquisicion' => Yii::t('app', 'Fecha Adquisicion'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivoIntangible()
    {
        return $this->hasOne(ActivosIntangibles::className(), ['id' => 'activo_intangible_id']);
    }
}
