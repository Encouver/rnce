<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.b2_otras_cuentas_por_cobrar".
 *
 * @property integer $id
 * @property string $criterio
 * @property string $origen
 * @property string $fecha
 * @property string $garantia
 * @property boolean $corriente
 * @property boolean $nocorriente
 * @property integer $plazo_contrato_c
 * @property string $saldo_neto_c
 * @property integer $plazo_contrato_nc
 * @property string $saldo_neto_nc
 * @property integer $criterio_id
 * @property string $otro_nombre
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
 */
class CuentasB2OtrasCuentasPorCobrar extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.b2_otras_cuentas_por_cobrar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['criterio', 'origen', 'fecha', 'contratista_id', 'anho'], 'required'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['corriente', 'nocorriente', 'sys_status'], 'boolean'],
            [['plazo_contrato_c', 'plazo_contrato_nc', 'criterio_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_neto_c', 'saldo_neto_nc'], 'number'],
            [['criterio', 'origen', 'garantia', 'otro_nombre'], 'string', 'max' => 255],
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
            'criterio' => Yii::t('app', 'Criterio'),
            'origen' => Yii::t('app', 'Origen'),
            'fecha' => Yii::t('app', 'Fecha'),
            'garantia' => Yii::t('app', 'Garantia'),
            'corriente' => Yii::t('app', 'Corriente'),
            'nocorriente' => Yii::t('app', 'No corriente'),
            'plazo_contrato_c' => Yii::t('app', 'Plazo del contrato'),
            'saldo_neto_c' => Yii::t('app', 'Saldo neto segun contabilidad'),
            'plazo_contrato_nc' => Yii::t('app', 'Plazo del contrato'),
            'saldo_neto_nc' => Yii::t('app', 'Saldo neto segun contabilidad'),
            'criterio_id' => Yii::t('app', 'Criterio ID'),
            'otro_nombre' => Yii::t('app', 'Otro Nombre'),
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

    public function getFormAttribs(){
        return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                
                'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
                'nocorriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
                'hh_concepto_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasConceptos::find()->where(['cuenta' => 'hh'])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 'label'=>'Concepto'],                
                'otro_nombre'=>['type'=>Form::INPUT_TEXT,'label'=>'Especifique'],
                'saldo_p_anterior'=>['type'=>Form::INPUT_TEXT, 'label'=>'Saldo del período anterior'],
                'importe_gasto_ejer_eco'=>['type'=>Form::INPUT_TEXT,'label'=>'Importe gasto'],
                'importe_pago_ejer_eco'=>['type'=>Form::INPUT_TEXT,'label'=>'Importe pago'],
            ];
    } 
}
