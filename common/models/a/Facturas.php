<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.facturas".
 *
 * @property integer $id
 * @property string $num_factura
 * @property integer $proveedor_id
 * @property string $fecha_emision
 * @property integer $imprenta_id
 * @property string $fecha_emision_talonario
 * @property integer $comprador_id
 * @property string $base_imponible_gravable
 * @property string $exento
 * @property string $iva
 * @property integer $contratista_id
 * @property integer $bien_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property PersonasJuridicas $comprador
 * @property PersonasJuridicas $contratista
 * @property PersonasJuridicas $imprenta
 * @property PersonasJuridicas $proveedor
 * @property Bienes $bien
 */
class Facturas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.facturas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_factura', 'proveedor_id', 'fecha_emision', 'imprenta_id', 'fecha_emision_talonario', 'comprador_id', 'base_imponible_gravable', 'iva', 'contratista_id', 'bien_id'], 'required'],
            [['proveedor_id', 'imprenta_id', 'comprador_id', 'contratista_id', 'bien_id'], 'integer'],
            [['fecha_emision', 'fecha_emision_talonario', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['base_imponible_gravable', 'exento', 'iva'], 'number'],
            [['sys_status'], 'boolean'],
            [['num_factura'], 'string', 'max' => 255],
            [['proveedor_id', 'num_factura'], 'unique', 'targetAttribute' => ['proveedor_id', 'num_factura'], 'message' => 'The combination of Num Factura and Proveedor ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'num_factura' => Yii::t('app', 'Num Factura'),
            'proveedor_id' => Yii::t('app', 'Proveedor ID'),
            'fecha_emision' => Yii::t('app', 'Fecha Emision'),
            'imprenta_id' => Yii::t('app', 'Imprenta ID'),
            'fecha_emision_talonario' => Yii::t('app', 'Fecha Emision Talonario'),
            'comprador_id' => Yii::t('app', 'Comprador ID'),
            'base_imponible_gravable' => Yii::t('app', 'Base Imponible Gravable'),
            'exento' => Yii::t('app', 'Exento'),
            'iva' => Yii::t('app', 'Iva'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprador()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'comprador_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImprenta()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'imprenta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'proveedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }
}
