<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.capitales_mercancias".
 *
 * @property integer $id
 * @property double $monto
 * @property integer $codigo_producto_id
 * @property string $fecha
 * @property integer $capital_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class CapitalesMercancias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.capitales_mercancias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto', 'codigo_producto_id', 'fecha', 'capital_id'], 'required'],
            [['monto'], 'number'],
            [['codigo_producto_id', 'capital_id'], 'integer'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'monto' => Yii::t('app', 'Monto'),
            'codigo_producto_id' => Yii::t('app', 'Codigo Producto ID'),
            'fecha' => Yii::t('app', 'Fecha'),
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
