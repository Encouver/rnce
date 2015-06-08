<?php

namespace common\models\c;

use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * This is the model class for table "cuentas.d1_d2_beneficiario".
 *
 * @property integer $id
 * @property string $nro_planilla
 * @property string $periodo
 * @property string $monto
 * @property integer $sys_naturales_juridicas_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $cuenta_id
 * @property string $cuenta
 */
class CuentasD1D2Beneficiario extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.d1_d2_beneficiario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nro_planilla', 'periodo', 'monto', 'sys_naturales_juridicas_id'], 'required'],
            [['monto'], 'number'],
            [['sys_naturales_juridicas_id', 'creado_por', 'actualizado_por', 'cuenta_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nro_planilla'], 'string', 'max' => 255],
            [['periodo'], 'string', 'max' => 200],
            [['cuenta'], 'string', 'max' => 50]
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nro_planilla' => Yii::t('app', 'Nro Planilla'),
            'periodo' => Yii::t('app', 'Periodo'),
            'monto' => Yii::t('app', 'Monto'),
            'sys_naturales_juridicas_id' => Yii::t('app', 'Beneficiario'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'cuenta_id' => Yii::t('app', 'Cuenta ID'),
            'cuenta' => Yii::t('app', 'Cuenta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentaD1Islr()
    {
        return $this->hasOne(CuentasD1IslrPagadoAnticipo::className(), ['id' => 'cuenta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentaD2OtrosTributosPagados()
    {
        return $this->hasOne(CuentasD2OtrosTributosPag::className(), ['id' => 'cuenta_id']);
    }

    public function getFormAttribs($i = 0) {
        return [
            // primary key column
            '['.$i.']id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            '['.$i.']sys_naturales_juridicas_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[//'data'=>ArrayHelper::map(SysNaturalesJuridicas::find()->all(),'id',function($model){return $model->etiqueta(); }),
                'options'=>['id'=>'beneficiario-'.uniqid()],'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'ajax' => [
                        'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                ],]],

            '['.$i.']nro_planilla'=>['type'=>Form::INPUT_TEXT,],
            '['.$i.']periodo'=>['type'=>Form::INPUT_TEXT,],
            '['.$i.']monto'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],


        ];
    }
}
