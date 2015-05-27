<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.bb1_cuentas_por_pagar_comerciales".
 *
 * @property integer $id
 * @property integer $proveedor_id
 * @property integer $cantidad_factura
 * @property string $saldo_al_cierre
 * @property string $intereses_actividad_e
 * @property boolean $corriente
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property EmpresasRelacionadas $proveedor
 */
class CuentasBb1CuentasPorPagarComerciales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.bb1_cuentas_por_pagar_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proveedor_id', 'cantidad_factura', 'saldo_al_cierre', 'corriente', 'contratista_id', 'anho'], 'required'],
            [['proveedor_id', 'cantidad_factura', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_al_cierre', 'intereses_actividad_e'], 'number'],
            [['corriente', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'proveedor_id' => Yii::t('app', 'Proveedor ID'),
            'cantidad_factura' => Yii::t('app', 'Cantidad Factura'),
            'saldo_al_cierre' => Yii::t('app', 'Saldo Al Cierre'),
            'intereses_actividad_e' => Yii::t('app', 'Intereses Actividad E'),
            'corriente' => Yii::t('app', 'Corriente'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
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
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(EmpresasRelacionadas::className(), ['id' => 'proveedor_id']);
    }
}
