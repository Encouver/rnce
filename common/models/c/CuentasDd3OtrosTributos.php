<?php

namespace common\models\c;

use Yii;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\ActiveFormEvent;
use yii\helpers\Html;

use common\models\c\CuentasConceptos;

/**
 * This is the model class for table "cuentas.dd3_otros_tributos".
 *
 * @property integer $id
 * @property string $saldo_p_anterior
 * @property string $importe_gasto_ejer_eco
 * @property string $importe_pago_ejer_eco
 * @property string $saldo_al_cierre
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $concepto_id
 * @property integer $otro_nombre
 *
 * @property CuentasConceptos $concepto
 * @property Contratistas $contratista
 */
class CuentasDd3OtrosTributos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.dd3_otros_tributos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saldo_p_anterior', 'importe_gasto_ejer_eco', 'importe_pago_ejer_eco', 'contratista_id', 'anho', 'concepto_id'], 'required'],
            [['saldo_p_anterior', 'importe_gasto_ejer_eco', 'importe_pago_ejer_eco', 'saldo_al_cierre'], 'number'],
            [['contratista_id', 'creado_por', 'actualizado_por', 'concepto_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['otro_nombre', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'saldo_p_anterior' => Yii::t('app', 'Saldo P Anterior'),
            'importe_gasto_ejer_eco' => Yii::t('app', 'Importe Gasto Ejer Eco'),
            'importe_pago_ejer_eco' => Yii::t('app', 'Importe Pago Ejer Eco'),
            'saldo_al_cierre' => Yii::t('app', 'Saldo Al Cierre'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'concepto_id' => Yii::t('app', 'Concepto ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(CuentasConceptos::className(), ['id' => 'concepto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    public function getFormAttribs(){
        return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                
                //'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
                'concepto_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasConceptos::find()->where(['cuenta' => 'dd3'])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 'label'=>'Concepto'],                
                'otro_nombre'=>['type'=>Form::INPUT_TEXT,'label'=>'Especifique'],
                'saldo_p_anterior'=>['type'=>Form::INPUT_TEXT, 'label'=>'Saldo del período anterior'],              
                'importe_gasto_ejer_eco'=>['type'=>Form::INPUT_TEXT,'label'=>'Importe gasto'],
                'importe_pago_ejer_eco'=>['type'=>Form::INPUT_TEXT,'label'=>'Importe pago'],
            ];
    }
}
