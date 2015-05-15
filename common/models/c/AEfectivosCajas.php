<?php

namespace common\models\c;



use Yii;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\ActiveFormEvent;
use yii\helpers\Html;
//use common\models\p\BancosContratistas;
use common\models\p\SysDivisas;
use common\models\p\NombresCajas;

/**
 * This is the model class for table "cuentas.a_efectivos_cajas".
 *
 * @property integer $id
 * @property integer $nombre_caja_id
 * @property string $saldo_cierre_ae
 * @property integer $tipo_moneda_id
 * @property string $monto_me
 * @property string $tipo_cambio_cierre
 * @property boolean $nacional
 * @property integer $total_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 *
 * @property NombresCajas $nombreCaja
 * @property Contratistas $contratista
 * @property User $creadoPor
 * @property SysDivisas $tipoMoneda
 */
class AEfectivosCajas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.a_efectivos_cajas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_caja_id', 'tipo_moneda_id', 'contratista_id', 'creado_por'], 'integer'],
            [['saldo_cierre_ae', 'nombre_caja_id'], 'required', 'on' => 'nacional'],
            [['saldo_cierre_ae', 'nombre_caja_id', 'tipo_moneda_id', 'monto_me', 'tipo_cambio_cierre'], 'required', 'on' => 'extranjero'],
            [['saldo_cierre_ae', 'monto_me', 'tipo_cambio_cierre'], 'number'],
            [['nacional', 'sys_status'], 'boolean'],
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
            'nombre_caja_id' => Yii::t('app', 'Nombre Caja ID'),
            'saldo_cierre_ae' => Yii::t('app', 'Saldo Cierre Ae'),
            'tipo_moneda_id' => Yii::t('app', 'Tipo Moneda ID'),
            'monto_me' => Yii::t('app', 'Monto Me'),
            'tipo_cambio_cierre' => Yii::t('app', 'Tipo Cambio Cierre'),
            'nacional' => Yii::t('app', 'Nacional'),
            'total_id' => Yii::t('app', 'Total ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreCaja()
    {
        return $this->hasOne(NombresCajas::className(), ['id' => 'nombre_caja_id']);
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
    public function getTipoMoneda()
    {
        return $this->hasOne(SysDivisas::className(), ['id' => 'tipo_moneda_id']);
    }

    public function getFormAttribs($id){
        
        if($id=='nacional')
        {

            return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                'nombre_caja_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(NombresCajas::find()->where(['nacional' => true])->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Nombre caja'],
                'saldo_cierre_ae'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo cierre'],
                //'tipo_moneda_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(SysDivisas::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Divisa'],
                //'monto_me'=>['type'=>Form::INPUT_TEXT,'label'=>'Depositos en transito'],
                //'tipo_cambio_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Nc no contabilizadas'],
            ];

        }else
        {

           return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                'nombre_caja_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(NombresCajas::find()->where(['nacional' => false])->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Nombre caja'],
                'saldo_cierre_ae'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo cierre'],
                'tipo_moneda_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(SysDivisas::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Divisa'],
                'monto_me'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto moneda extranjera'],
                'tipo_cambio_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Tipo de cambio al cierre'],
            ];
        }
    }
}
