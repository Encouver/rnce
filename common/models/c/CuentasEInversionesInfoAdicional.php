<?php

namespace common\models\c;

use common\models\a\ActivosSysMetodos;
use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

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
            'gan_per_ajustada' => Yii::t('app', 'Ganancia o Perdida Ajustada'),
            'prima_descuento' => Yii::t('app', 'Prima Descuento'),
            'monto_prima_des' => Yii::t('app', 'Monto Prima Descuento'),
            'plazo' => Yii::t('app', 'Plazo'),
            'tasa' => Yii::t('app', 'Tasa'),
            'cotiza_bolsa_valores' => Yii::t('app', 'Cotiza en la Bolsa  de Valores'),
            'gtia_oblig_bancaria' => Yii::t('app', 'Garantía Obligaciones Bancarias'),
            'sys_metodo_id' => Yii::t('app', 'Método'),
            'deterioro' => Yii::t('app', 'Deterioro'),
            'valor_razonable' => Yii::t('app', 'Valor Razonable'),
            'costos_disposicion' => Yii::t('app', 'Costos de Disposición'),
            'valor_uso' => Yii::t('app', 'Valor de Uso'),
            'valor_mercado' => Yii::t('app', 'Valor de Mercado'),
            'deterioro_acumulado' => Yii::t('app', 'Deterioro Acumulado'),
            'varia_efecto_infla' => Yii::t('app', 'Variación por efecto Inflación'),
            'resultado_det_cam_val' => Yii::t('app', 'Resultado en el Deterioro o Cambio al Valor'),
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


    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            //Solo para retiroS
            'precio_adquisicion'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>['prefix'=>'','precision'=>'0'],]],

            //Si tiene prima descuento
            'prima_descuento'=>['type'=>Form::INPUT_CHECKBOX,],
            'monto_prima_des'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],

            //Solo para Bonos
            'plazo'=>['type'=>Form::INPUT_TEXT,],
            'tasa'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],

            'cotiza_bolsa_valores'=>['type'=>Form::INPUT_CHECKBOX,],
            //Vincula con Obligaciones Bancarias
            'gtia_oblig_bancaria'=>['type'=>Form::INPUT_CHECKBOX,],

            //Si cotizan en la bolsa debe ser el metodo del valor razonable
            'sys_metodo_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysMetodos::find()->all(),'id','nombre'), ]],


            'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],

            // Metodo del costo
            'valor_razonable'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'costos_disposicion'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'valor_uso'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            //Metodo del valor razonable
            'valor_mercado'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],

            'deterioro_acumulado'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],

            // Sistema
           // 'varia_efecto_infla'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
           // 'resultado_det_cam_val'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            //'sdo_cierre_ejer_econ'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],


            'intereses_gen_ejer_econ'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],


        ];
    }
}
