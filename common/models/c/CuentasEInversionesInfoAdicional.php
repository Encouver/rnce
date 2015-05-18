<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.e_inversiones_info_adicional".
 *
 * @property integer $id
 * @property string $precio_adquisicion
 * @property string $gan_per
 * @property string $gan_per_ajustada
 * @property boolean $prima_descuento
 * @property string $monto_prima_des
 * @property integer $plazo
 * @property string $tasa
 * @property boolean $cotiza_bolsa_valores
 * @property boolean $gtia_oblig_bancaria
 * @property integer $sys_metodo_id
 * @property boolean $deterioro
 * @property string $valor_razonable
 * @property string $costos_disposicion
 * @property string $valor_uso
 * @property string $valor_mercado
 * @property string $deterioro_acumulado
 * @property string $varia_efecto_infla
 * @property string $resultado_det_cam_val
 * @property string $sdo_cierre_ejer_econ
 * @property string $intereses_gen_ejer_econ
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasEInversiones[] $cuentasEInversiones
 * @property ActivosSysMetodos $sysMetodo
 */
class CuentasEInversionesInfoAdicional extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.e_inversiones_info_adicional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['precio_adquisicion', 'gan_per', 'gan_per_ajustada', 'prima_descuento', 'cotiza_bolsa_valores', 'gtia_oblig_bancaria', 'sys_metodo_id', 'deterioro'], 'required'],
            [['precio_adquisicion', 'gan_per', 'gan_per_ajustada', 'monto_prima_des', 'tasa', 'valor_razonable', 'costos_disposicion', 'valor_uso', 'valor_mercado', 'deterioro_acumulado', 'varia_efecto_infla', 'resultado_det_cam_val', 'sdo_cierre_ejer_econ', 'intereses_gen_ejer_econ'], 'number'],
            [['prima_descuento', 'cotiza_bolsa_valores', 'gtia_oblig_bancaria', 'deterioro', 'sys_status'], 'boolean'],
            [['plazo', 'sys_metodo_id', 'creado_por', 'actualizado_por'], 'integer'],
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
            'precio_adquisicion' => Yii::t('app', 'Precio Adquisicion'),
            'gan_per' => Yii::t('app', 'Gan Per'),
            'gan_per_ajustada' => Yii::t('app', 'Gan Per Ajustada'),
            'prima_descuento' => Yii::t('app', 'Prima Descuento'),
            'monto_prima_des' => Yii::t('app', 'Monto Prima Des'),
            'plazo' => Yii::t('app', 'Plazo'),
            'tasa' => Yii::t('app', 'Tasa'),
            'cotiza_bolsa_valores' => Yii::t('app', 'Cotiza Bolsa Valores'),
            'gtia_oblig_bancaria' => Yii::t('app', 'Gtia Oblig Bancaria'),
            'sys_metodo_id' => Yii::t('app', 'Sys Metodo ID'),
            'deterioro' => Yii::t('app', 'Deterioro'),
            'valor_razonable' => Yii::t('app', 'Valor Razonable'),
            'costos_disposicion' => Yii::t('app', 'Costos Disposicion'),
            'valor_uso' => Yii::t('app', 'Valor Uso'),
            'valor_mercado' => Yii::t('app', 'Valor Mercado'),
            'deterioro_acumulado' => Yii::t('app', 'Deterioro Acumulado'),
            'varia_efecto_infla' => Yii::t('app', 'Varia Efecto Infla'),
            'resultado_det_cam_val' => Yii::t('app', 'Resultado Det Cam Val'),
            'sdo_cierre_ejer_econ' => Yii::t('app', 'Sdo Cierre Ejer Econ'),
            'intereses_gen_ejer_econ' => Yii::t('app', 'Intereses Gen Ejer Econ'),
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
    public function getCuentasEInversiones()
    {
        return $this->hasMany(CuentasEInversiones::className(), ['e_inversion_info_adicional_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMetodo()
    {
        return $this->hasOne(ActivosSysMetodos::className(), ['id' => 'sys_metodo_id']);
    }
}
