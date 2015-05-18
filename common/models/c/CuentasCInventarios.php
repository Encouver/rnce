<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.c_inventarios".
 *
 * @property integer $id
 * @property integer $tipo_inventario_id
 * @property string $detalle_inventario
 * @property integer $tecnica_medicion_id
 * @property integer $formula_tecnica_id
 * @property string $inventario_inicial
 * @property string $compra_ejercicio
 * @property string $ventas_ejercicio
 * @property string $inventario_final
 * @property string $valor_neto_realizacion
 * @property integer $frecuencia_rotacion
 * @property string $variacion_inflacion
 * @property string $costo_ajustado
 * @property string $deterioro
 * @property string $reverso_deterioro
 * @property string $valor_neto_ajus_cierre
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 */
class CuentasCInventarios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.c_inventarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_inventario_id', 'detalle_inventario', 'tecnica_medicion_id', 'formula_tecnica_id', 'inventario_inicial', 'compra_ejercicio', 'ventas_ejercicio', 'inventario_final', 'valor_neto_realizacion', 'frecuencia_rotacion', 'variacion_inflacion', 'costo_ajustado', 'deterioro', 'reverso_deterioro', 'valor_neto_ajus_cierre'], 'required'],
            [['tipo_inventario_id', 'tecnica_medicion_id', 'formula_tecnica_id', 'frecuencia_rotacion', 'creado_por', 'actualizado_por'], 'integer'],
            [['inventario_inicial', 'compra_ejercicio', 'ventas_ejercicio', 'inventario_final', 'valor_neto_realizacion', 'variacion_inflacion', 'costo_ajustado', 'deterioro', 'reverso_deterioro', 'valor_neto_ajus_cierre'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['detalle_inventario'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_inventario_id' => Yii::t('app', 'Tipo Inventario ID'),
            'detalle_inventario' => Yii::t('app', 'Detalle Inventario'),
            'tecnica_medicion_id' => Yii::t('app', 'Tecnica Medicion ID'),
            'formula_tecnica_id' => Yii::t('app', 'Formula Tecnica ID'),
            'inventario_inicial' => Yii::t('app', 'Inventario Inicial'),
            'compra_ejercicio' => Yii::t('app', 'Compra Ejercicio'),
            'ventas_ejercicio' => Yii::t('app', 'Ventas Ejercicio'),
            'inventario_final' => Yii::t('app', 'Inventario Final'),
            'valor_neto_realizacion' => Yii::t('app', 'Valor Neto Realizacion'),
            'frecuencia_rotacion' => Yii::t('app', 'Frecuencia Rotacion'),
            'variacion_inflacion' => Yii::t('app', 'Variacion Inflacion'),
            'costo_ajustado' => Yii::t('app', 'Costo Ajustado'),
            'deterioro' => Yii::t('app', 'Deterioro'),
            'reverso_deterioro' => Yii::t('app', 'Reverso Deterioro'),
            'valor_neto_ajus_cierre' => Yii::t('app', 'Valor Neto Ajus Cierre'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }
}
