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
 * This is the model class for table "cuentas.jj_proviciones".
 *
 * @property integer $id
 * @property integer $concepto_id
 * @property string $saldo_p_anterior
 * @property string $importe_provisionado_periodo
 * @property string $aplicacion_amortizacion
 * @property string $saldo_al_cierre
 * @property boolean $corriente
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $otro_nombre
 *
 * @property Contratistas $contratista
 */
class CuentasJjProviciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.jj_proviciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['concepto_id', 'saldo_p_anterior', 'importe_provisionado_periodo', 'aplicacion_amortizacion', 'contratista_id', 'anho'], 'required'],
            [['saldo_p_anterior', 'concepto_id','importe_provisionado_periodo', 'aplicacion_amortizacion', 'saldo_al_cierre'], 'number'],
            [['corriente', 'sys_status'], 'boolean'],
            [['contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'otro_nombre', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'concepto_id' => Yii::t('app', 'Concepto'),
            'saldo_p_anterior' => Yii::t('app', 'Saldo P Anterior'),
            'importe_provisionado_periodo' => Yii::t('app', 'Importe Provisionado Periodo'),
            'aplicacion_amortizacion' => Yii::t('app', 'Aplicacion Amortizacion'),
            'saldo_al_cierre' => Yii::t('app', 'Saldo Al Cierre'),
            'corriente' => Yii::t('app', 'Corriente'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'otro_nombre' => Yii::t('app', 'Otro nombre'),
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
    public function getConcepto()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'concepto_id']);
    }

    public function getFormAttribs(){
        return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                
                'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
                'concepto_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasSysConceptos::find()->where(['cuenta' => 'jj'])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 'label'=>'Concepto'],
                'otro_nombre'=>['type'=>Form::INPUT_TEXT,'label'=>'Otro nombre'],
                'importe_provisionado_periodo'=>['type'=>Form::INPUT_TEXT,'label'=>'Importe provisionado del periodo'],
                'saldo_p_anterior'=>['type'=>Form::INPUT_TEXT, 'label'=>'Saldo del período anterior'],
                'aplicacion_amortizacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Aplicacion o amrtozación del periodo'],
            ];
    }
}
