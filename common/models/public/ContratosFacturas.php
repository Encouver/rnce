<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.contratos_facturas".
 *
 * @property integer $id
 * @property integer $relacion_contrato_id
 * @property integer $orden_factura
 * @property string $monto
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property RelacionesContratos $relacionContrato
 */
class ContratosFacturas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.contratos_facturas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relacion_contrato_id', 'orden_factura', 'monto'], 'required'],
            [['relacion_contrato_id', 'orden_factura'], 'integer'],
            [['monto'], 'number'],
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
            'relacion_contrato_id' => Yii::t('app', 'Relacion Contrato ID'),
            'orden_factura' => Yii::t('app', 'Orden Factura'),
            'monto' => Yii::t('app', 'Monto'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionContrato()
    {
        return $this->hasOne(RelacionesContratos::className(), ['id' => 'relacion_contrato_id']);
    }
}
