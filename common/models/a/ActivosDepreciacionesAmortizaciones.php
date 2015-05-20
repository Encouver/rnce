<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.depreciaciones_amortizaciones".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $costo_adquisicion_avaluo
 * @property string $fecha_adquisicion_avaluo
 * @property integer $vida_util
 * @property string $valor_residual
 * @property string $valor_depreciar
 * @property string $tasa_anual
 * @property integer $unidades_estimadas
 * @property string $bs_unidad
 * @property integer $unidades_producidas_periodo
 * @property integer $unidades_consumidas
 * @property string $costo_avaluo
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 */
class ActivosDepreciacionesAmortizaciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.depreciaciones_amortizaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'costo_adquisicion_avaluo', 'fecha_adquisicion_avaluo'], 'required'],
            [['bien_id', 'vida_util', 'unidades_estimadas', 'unidades_producidas_periodo', 'unidades_consumidas', 'creado_por', 'actualizado_por'], 'integer'],
            [['costo_adquisicion_avaluo', 'valor_residual', 'valor_depreciar', 'tasa_anual', 'bs_unidad', 'costo_avaluo'], 'number'],
            [['fecha_adquisicion_avaluo', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'bien_id' => Yii::t('app', 'Bien ID'),
            'costo_adquisicion_avaluo' => Yii::t('app', 'Costo Adquisicion Avaluo'),
            'fecha_adquisicion_avaluo' => Yii::t('app', 'Fecha Adquisicion Avaluo'),
            'vida_util' => Yii::t('app', 'Vida Util'),
            'valor_residual' => Yii::t('app', 'Valor Residual'),
            'valor_depreciar' => Yii::t('app', 'Valor Depreciar'),
            'tasa_anual' => Yii::t('app', 'Tasa Anual'),
            'unidades_estimadas' => Yii::t('app', 'Unidades Estimadas'),
            'bs_unidad' => Yii::t('app', 'Bs. Unidad'),
            'unidades_producidas_periodo' => Yii::t('app', 'Unidades Producidas Periodo'),
            'unidades_consumidas' => Yii::t('app', 'Unidades Consumidas'),
            'costo_avaluo' => Yii::t('app', 'Costo Avaluo'),
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

            'costo_adquisicion_avaluo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'fecha_adquisicion_avaluo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>false]
            ],
            'vida_util'=>['type'=>Form::INPUT_TEXT,],
            'valor_residual'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'valor_depreciar'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'tasa_anual'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'unidades_estimadas'=>['type'=>Form::INPUT_TEXT,],
            'bs_unidad'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],
            'unidades_producidas_periodo' => ['type'=>Form::INPUT_TEXT,],
            'unidades_consumidas' => ['type'=>Form::INPUT_TEXT,],
            'costo_avaluo' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>[],]],

        ];
    }
}
