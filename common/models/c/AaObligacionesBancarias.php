<?php

namespace common\models\c;

use common\models\p\SysBancos;
use kartik\builder\Form;
use kartik\builder\TabularForm;
use kartik\checkbox\CheckboxX;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuentas.aa_obligaciones_bancarias".
 *
 * @property integer $id
 * @property boolean $corriente
 * @property integer $banco_id
 * @property string $num_documento
 * @property string $monto_otorgado
 * @property string $fecha_prestamo
 * @property string $fecha_vencimiento
 * @property string $tasa_interes
 * @property integer $condicion_pago_id
 * @property integer $plazo
 * @property integer $tipo_garantia_id
 * @property string $interes_ejer_econ
 * @property string $interes_pagar
 * @property string $importe_deuda
 * @property integer $total_imp_deu_int
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property AaCondicionesPagos $condicionPago
 * @property AaTiposGarantias $tipoGarantia
 * @property SysTotales $totalImpDeuInt
 * @property SysBancos $banco
 */
class AaObligacionesBancarias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.aa_obligaciones_bancarias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['corriente', 'banco_id', 'num_documento', 'monto_otorgado', 'fecha_prestamo', 'fecha_vencimiento', 'tasa_interes', 'condicion_pago_id', 'plazo', 'tipo_garantia_id', 'interes_ejer_econ', 'interes_pagar', 'importe_deuda', 'total_imp_deu_int', 'contratista_id', 'anho',], 'required'],
            [['corriente', 'sys_status'], 'boolean'],
            [['banco_id', 'condicion_pago_id', 'plazo', 'tipo_garantia_id', 'total_imp_deu_int', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['monto_otorgado', 'tasa_interes', 'interes_ejer_econ', 'interes_pagar', 'importe_deuda'], 'number'],
            [['fecha_prestamo', 'fecha_vencimiento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_documento'], 'string', 'max' => 255],
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
            'corriente' => Yii::t('app', 'Corriente'),
            'banco_id' => Yii::t('app', 'Banco'),
            'num_documento' => Yii::t('app', 'Num. Documento'),
            'monto_otorgado' => Yii::t('app', 'Monto otorgado'),
            'fecha_prestamo' => Yii::t('app', 'Fecha de prestamo'),
            'fecha_vencimiento' => Yii::t('app', 'Fecha de vencimiento'),
            'tasa_interes' => Yii::t('app', 'Tasa de interes'),
            'condicion_pago_id' => Yii::t('app', 'Condicion de pago'),
            'plazo' => Yii::t('app', 'Plazo'),
            'tipo_garantia_id' => Yii::t('app', 'Tipo Garantia'),
            'interes_ejer_econ' => Yii::t('app', 'Interes Ejercicio Económico'),
            'interes_pagar' => Yii::t('app', 'Interes por pagar'),
            'importe_deuda' => Yii::t('app', 'Importe deuda'),
            'total_imp_deu_int' => Yii::t('app', 'TOTAL de importe de la deuda más intereses'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'anho' => Yii::t('app', 'Año'),
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
    public function getCondicionPago()
    {
        return $this->hasOne(AaCondicionesPagos::className(), ['id' => 'condicion_pago_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoGarantia()
    {
        return $this->hasOne(AaTiposGarantias::className(), ['id' => 'tipo_garantia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotalImpDeuInt()
    {
        return $this->hasOne(SysTotales::className(), ['id' => 'total_imp_deu_int']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanco()
    {
        return $this->hasOne(SysBancos::className(), ['id' => 'banco_id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'corriente'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],

            'banco_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(SysBancos::find()->asArray()->all(),'id','nombre'),
                'options'=>['id'=>'banco','placeholder'=>'Seleccionar banco', 'onchange'=>'js:'],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'num_documento'=>['type'=>Form::INPUT_TEXT,],
            'monto_otorgado'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'fecha_prestamo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            'fecha_vencimiento'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(), 'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            'tasa_interes'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>CheckboxX::className()],
            'condicion_pago_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(\common\models\c\AaCondicionesPagos::find()->asArray()->all(),'id','nombre'),],
            'plazo'=>['type'=>Form::INPUT_TEXT, /*'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions' => [
                'prefix' => '',
                'suffix' => ' Día/s',
                //'affixesStay'=> false,
                //'precision' => 0,
                'allowNegative' => false,
                //'thousands'=>'',
                //'decimals'=>''
                ],]*/
            ],

            'tipo_garantia_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(\common\models\c\AaTiposGarantias::find()->asArray()->all(),'id','nombre'),
                'options'=>['id'=>'tipo-garantia','placeholder'=>'Seleccionar tipo garantía', 'onchange'=>'js:'],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'interes_ejer_econ'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>MaskMoney::className()],
            'interes_pagar'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>MaskMoney::className()],
            'importe_deuda'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>MaskMoney::className()],
            //'total_imp_deu_int'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>MaskMoney::className()],
/*            'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
            'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
            'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
            'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
            'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],*/


        ];
    }
}
