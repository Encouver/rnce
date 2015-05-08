<?php

namespace common\models\c;

use Yii;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\ActiveFormEvent;
use yii\helpers\Html;


/**
 * This is the model class for table "cuentas.a_efectivos_bancos".
 *
 * @property integer $id
 * @property integer $banco_contratista_id
 * @property string $saldo_segun_b
 * @property string $nd_no_cont
 * @property string $depo_transito
 * @property string $nc_no_cont
 * @property string $cheques_transito
 * @property string $saldo_al_cierre
 * @property string $intereses_act_eco
 * @property integer $tipo_moneda_id
 * @property string $monto_moneda_extra
 * @property string $tipo_cambio_cierre
 * @property integer $creado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $total_id
 *
 * @property BancosContratistas $bancoContratista
 * @property Contratistas $contratista
 * @property User $creadoPor
 * @property SysTotales $total
 * @property SysDivisas $tipoMoneda
 */
class AEfectivosBancos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.a_efectivos_bancos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banco_contratista_id', 'nd_no_cont', 'depo_transito', 'nc_no_cont', 'cheques_transito', 'saldo_al_cierre', 'intereses_act_eco', 'total_id'], 'required'],
            [['banco_contratista_id', 'tipo_moneda_id', 'creado_por', 'contratista_id', 'total_id'], 'integer'],
            [['saldo_segun_b', 'nd_no_cont', 'depo_transito', 'nc_no_cont', 'cheques_transito', 'saldo_al_cierre', 'intereses_act_eco', 'monto_moneda_extra', 'tipo_cambio_cierre'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'banco_contratista_id' => Yii::t('app', 'Banco Contratista ID'),
            'saldo_segun_b' => Yii::t('app', 'Saldo Segun B'),
            'nd_no_cont' => Yii::t('app', 'Nd No Cont'),
            'depo_transito' => Yii::t('app', 'Depo Transito'),
            'nc_no_cont' => Yii::t('app', 'Nc No Cont'),
            'cheques_transito' => Yii::t('app', 'Cheques Transito'),
            'saldo_al_cierre' => Yii::t('app', 'Saldo Al Cierre'),
            'intereses_act_eco' => Yii::t('app', 'Intereses Act Eco'),
            'tipo_moneda_id' => Yii::t('app', 'Tipo Moneda ID'),
            'monto_moneda_extra' => Yii::t('app', 'Monto Moneda Extra'),
            'tipo_cambio_cierre' => Yii::t('app', 'Tipo Cambio Cierre'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'total_id' => Yii::t('app', 'Total ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancoContratista()
    {
        return $this->hasOne(BancosContratistas::className(), ['id' => 'banco_contratista_id']);
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
    public function getCreadoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'creado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotal()
    {
        return $this->hasOne(SysTotales::className(), ['id' => 'total_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMoneda()
    {
        return $this->hasOne(SysDivisas::className(), ['id' => 'tipo_moneda_id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'banco_contratista_id'=>['type'=>Form::INPUT_TEXT,'label'=>'Banco'],
            'saldo_segun_b'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo segun banco'],
            'nd_no_cont'=>['type'=>Form::INPUT_TEXT,'label'=>'Nd no contabilizadas'],
            'depo_transito'=>['type'=>Form::INPUT_TEXT,'label'=>'Depositos en transito'],
            'nc_no_cont'=>['type'=>Form::INPUT_TEXT,'label'=>'Nc no contabilizadas'],
            'cheques_transito'=>['type'=>Form::INPUT_TEXT,'label'=>'Cheques en transito'],
            'saldo_al_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo al cierre'],
            'intereses_act_eco'=>['type'=>Form::INPUT_TEXT,'label'=>'Intereses generados'],
            'tipo_moneda_id'=>['type'=>Form::INPUT_TEXT,'label'=>'Tipo moneda'],
            //'monto_moneda_extra'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo según Banco'],
            //'tipo_cambio_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo según Banco'],

            //'actions'=>['type'=>TabularForm::INPUT_RAW, 'value'=>Html::submitButton('Submit', ['class'=>'btn btn-primary'])]
        ];
    }
}