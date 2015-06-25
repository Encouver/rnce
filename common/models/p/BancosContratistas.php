<?php

namespace common\models\p;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use common\models\p\SysBancos;
use Yii;

/**
 * This is the model class for table "public.bancos_contratistas".
 *
 * @property integer $id
 * @property integer $banco_id
 * @property integer $contratista_id
 * @property string $num_cuenta
 * @property string $tipo_moneda
 * @property string $tipo_cuenta
 * @property string $estatus_cuenta
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property SysBancos $banco
 */
class BancosContratistas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $tipo_nacionalidad;
    public static function tableName()
    {
        return 'public.bancos_contratistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banco_id', 'contratista_id', 'num_cuenta', 'estatus_cuenta','tipo_nacionalidad'], 'required'],
            [['banco_id', 'contratista_id'], 'integer'],
            [['num_cuenta', 'tipo_moneda', 'tipo_cuenta', 'estatus_cuenta','tipo_nacionalidad'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_cuenta'], 'unique'],
            [['tipo_moneda','tipo_cuenta'], 'required', 'when' => function ($model) {
                return $model->tipo_nacionalidad == "NACIONAL";
            }, 'whenClient' => "function (attribute, value) {
                return $('#bancoscontratistas-tipo_nacionalidad').val() == 'NACIONAL';
            }"]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'banco_id' => Yii::t('app', 'Banco'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'num_cuenta' => Yii::t('app', 'Num Cuenta'),
            'tipo_moneda' => Yii::t('app', 'Tipo Moneda'),
            'tipo_cuenta' => Yii::t('app', 'Tipo Cuenta'),
            'tipo_nacionalidad' => Yii::t('app', 'Tipo Nacionalidad'),
            'estatus_cuenta' => Yii::t('app', 'Estatus Cuenta'),
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
    public function getBanco()
    {
        return $this->hasOne(SysBancos::className(), ['id' => 'banco_id']);
    }
    public function getFormAttribs() {

         return [
        'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA'],'options'=>['prompt'=>'Seleccione Nacionalidad']],
        'banco_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysBancos::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione estado']],
        'num_cuenta'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca numero cuenta']],
        'tipo_moneda'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>['BOLIVARES' => 'BOLIVARES', 'DOLARES' => 'DOLARES', 'EUROS' => 'EUROS'],'options'=>['prompt'=>'Seleccione Moneda'],'hint'=>'Solo Bancos Venezolanos'],
        'tipo_cuenta'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'CUENTA CORRIENTE' => 'CUENTA CORRIENTE', 'CUENTA CORRIENTE CON INTERESES / REMUNERADA' => 'CUENTA CORRIENTE CON INTERESES / REMUNERADA', 'CUENTA DE AHORROS' => 'CUENTA DE AHORROS', 'CUENTA EN MONEDA EXTRANGERA' => 'CUENTA EN MONEDA EXTRANGERA', ],'options'=>['prompt'=>'Seleccione tipo cuenta'],'hint'=>'Solo Bancos Venezolanos'],    
        'estatus_cuenta'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'ACTIVA' => 'ACTIVA', 'INACTIVA' => 'INACTIVA', ],'options'=>['prompt'=>'Seleccione estatus']],
    ];
    
       
    }
}
