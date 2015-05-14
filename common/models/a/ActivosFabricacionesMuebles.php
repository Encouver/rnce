<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.fabricaciones_muebles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $cantidad
 * @property string $porcentaje_fabricacion
 * @property string $monto_ejecutado
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 */
class ActivosFabricacionesMuebles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.fabricaciones_muebles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'cantidad', 'porcentaje_fabricacion', 'monto_ejecutado'], 'required'],
            [['bien_id'], 'integer'],
            [['cantidad', 'porcentaje_fabricacion', 'monto_ejecutado'], 'number'],
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
            'bien_id' => Yii::t('app', 'Bien ID'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'porcentaje_fabricacion' => Yii::t('app', 'Porcentaje Fabricacion'),
            'monto_ejecutado' => Yii::t('app', 'Monto Ejecutado'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
    }

    public function getFormAttribs() {
    return [
        // primary key column
        'id'=>[ // primary key attribute
            'type'=>Form::INPUT_HIDDEN,
            'columnOptions'=>['hidden'=>true]
        ],
        'cantidad'=>['type'=>Form::INPUT_TEXT,],
        'porcentaje_fabricacion'=>['type'=>Form::INPUT_TEXT,],
        'monton_ejecutado'=>['type'=>Form::INPUT_TEXT,],

    ];
}
}
