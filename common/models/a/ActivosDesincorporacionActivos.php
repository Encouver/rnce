<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.desincorporacion_activos".
 *
 * @property integer $id
 * @property integer $sys_motivo_id
 * @property string $fecha
 * @property string $precio_venta
 * @property string $valor_neto_libro
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosSysMotivos $sysMotivo
 */
class ActivosDesincorporacionActivos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.desincorporacion_activos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_motivo_id', 'fecha', 'valor_neto_libro'], 'required'],
            [['sys_motivo_id'], 'integer'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['precio_venta', 'valor_neto_libro'], 'number'],
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
            'sys_motivo_id' => Yii::t('app', 'Sys Motivo ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'precio_venta' => Yii::t('app', 'Precio Venta'),
            'valor_neto_libro' => Yii::t('app', 'Valor Neto Libro'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMotivo()
    {
        return $this->hasOne(ActivosSysMotivos::className(), ['id' => 'sys_motivo_id']);
    }
}
