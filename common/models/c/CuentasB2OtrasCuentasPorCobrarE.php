<?php

namespace common\models\c;

use Yii;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\ActiveFormEvent;
use yii\helpers\Html;
//use kartik\popover\PopoverX;
use common\models\p\EmpresasRelacionadas;

/**
 * This is the model class for table "cuentas.b2_otras_cuentas_por_cobrar_e".
 *
 * @property integer $id
 * @property string $criterio
 * @property string $origen
 * @property string $fecha
 * @property string $garantia
 * @property boolean $corriente
 * @property boolean $nocorriente
 * @property integer $plazo_contrato_c
 * @property string $saldo_c
 * @property boolean $deterioro_c
 * @property string $valor_de_uso_c
 * @property string $saldo_neto_c
 * @property integer $plazo_contrato_nc
 * @property string $saldo_nc
 * @property boolean $deterioro_nc
 * @property string $valor_de_uso_nc
 * @property string $saldo_neto_nc
 * @property string $otro_nombre
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $empresa_id
 *
 * @property Contratistas $contratista
 * @property EmpresasRelacionadas $empresa0
 */
class CuentasB2OtrasCuentasPorCobrarE extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $empresa;

    public static function tableName()
    {
        return 'cuentas.b2_otras_cuentas_por_cobrar_e';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['criterio', 'origen', 'fecha', 'contratista_id', 'anho'], 'required'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['corriente', 'nocorriente', 'deterioro_c', 'deterioro_nc', 'sys_status'], 'boolean'],
            [['plazo_contrato_c', 'plazo_contrato_nc', 'contratista_id', 'creado_por', 'actualizado_por', 'empresa_id'], 'integer'],
            [['saldo_c', 'valor_de_uso_c', 'saldo_neto_c', 'saldo_nc', 'valor_de_uso_nc', 'saldo_neto_nc'], 'number'],
            [['criterio', 'origen', 'garantia', 'otro_nombre'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100],
            /*['corriente', 'compare', 'message' => 'Accionista no puede estar vacio', 'operator'=> '==', 'compareValue'=>true, 'when' => function ($model) {
                return ($model->corriente != 1 and $model->nocorriente != 1);
              }, 'whenClient' => "function (attribute, value) {
                return true;
            }"],*/
            [['plazo_contrato_c', 'saldo_c', 'deterioro_c'], 'required', 'when' => function ($model) {
                return $model->corriente == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#cuentasb2otrascuentasporcobrare-corriente').attr('checked');
            }"],
            [['plazo_contrato_nc', 'saldo_nc', 'deterioro_nc'], 'required', 'when' => function ($model) {
                return $model->nocorriente == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#cuentasb2otrascuentasporcobrare-nocorriente').attr('checked');
            }"],
            ['empresa_id', 'required', 'when' => function ($model) {
                return $model->criterio == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#cuentasb2otrascuentasporcobrare-criterio').val()==1;
            }"],
            ['otro_nombre', 'required', 'when' => function ($model) {
                return $model->criterio == 2;
            }, 'whenClient' => "function (attribute, value) {
                return $('#cuentasb2otrascuentasporcobrare-criterio').val()==2;
            }"],
            ['valor_de_uso_c', 'required', 'when' => function ($model) {
                return $model->valor_de_uso_c == '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#cuentasb2otrascuentasporcobrare-deterioro_c').is(':checked');
            }"],

            ['valor_de_uso_nc', 'required', 'when' => function ($model) {
                return $model->valor_de_uso_nc == '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#cuentasb2otrascuentasporcobrare-deterioro_nc').is(':checked');
            }"],            
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
            'nocorriente' => Yii::t('app', 'Nocorriente'),
            'plazo_contrato_c' => Yii::t('app', 'Plazo Contrato C'),
            'saldo_c' => Yii::t('app', 'Saldo C'),
            'deterioro_c' => Yii::t('app', 'Deterioro C'),
            'valor_de_uso_c' => Yii::t('app', 'Valor De Uso C'),
            'saldo_neto_c' => Yii::t('app', 'Saldo Neto C'),
            'plazo_contrato_nc' => Yii::t('app', 'Plazo Contrato Nc'),
            'saldo_nc' => Yii::t('app', 'Saldo Nc'),
            'deterioro_nc' => Yii::t('app', 'Deterioro Nc'),
            'valor_de_uso_nc' => Yii::t('app', 'Valor De Uso Nc'),
            'saldo_neto_nc' => Yii::t('app', 'Saldo Neto Nc'),
            'otro_nombre' => Yii::t('app', 'Otro Nombre'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'empresa_id' => Yii::t('app', 'Empresa'),
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
    public function getEmpresa0()
    {
        return $this->hasOne(EmpresasRelacionadas::className(), ['id' => 'empresa_id']);
    }

    public function getFormAttribs(){
        $arreglo = 
        [
            ['id'=>1, 'nombre' => 'Empresas'],
            ['id'=>2, 'nombre' => 'Otros'],
        ];

        $empresasR = EmpresasRelacionadas::find()->where(['contratista_id' => Yii::$app->user->identity->contratista_id])->orderBy('id')->asArray()->all();

        //print_r($empresasR);
        //if(empty($empresasR))
        $empresas = [];
        /*foreach ($empresasR as $key => $value) {
            $empresas = [['id' => $key, 'nombre' => $value->personaJuridica()->denominacion]];
        }*/

        return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                
                'criterio'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($arreglo, 'id', 'nombre'), 'label'=>'Criterio'],
                'empresa_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map($empresas, 'id', 'nombre'), 'label'=>'Empresas relacionadas'],
                'otro_nombre'=>['type'=>Form::INPUT_TEXT, 'label'=>'Especifique'],
                'origen'=>['type'=>Form::INPUT_TEXT,'label'=>'Origen'],
                'fecha'=>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DatePicker', 
                    'options'=>['pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]],
                 ],
                'garantia'=>['type'=>Form::INPUT_TEXT,'label'=>'Garantia'],
                'corriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Corriente'],
                'nocorriente'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'No corriente'],
                //'hh_concepto_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasConceptos::find()->where(['cuenta' => 'hh'])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 'label'=>'Concepto'],                
            ];
    }

    public function getFormA(){
        
        return [
                'plazo_contrato_c'=>['type'=>Form::INPUT_TEXT,'label'=>'Plazo del contrato'],
                'saldo_c'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo'],
                'deterioro_c'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Deterioro'],
                'valor_de_uso_c'=>['type'=>Form::INPUT_TEXT,'label'=>'Valor de uso'],
        ];
    }

    public function getFormB(){
        return [
                'plazo_contrato_nc'=>['type'=>Form::INPUT_TEXT,'label'=>'Plazo del contrato'],
                'saldo_nc'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo'],
                'deterioro_nc'=>['type'=>Form::INPUT_CHECKBOX,'label'=>'Deterioro'],
                'valor_de_uso_nc'=>['type'=>Form::INPUT_TEXT,'label'=>'Valor de uso'],
                //'hh_concepto_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasConceptos::find()->where(['cuenta' => 'hh'])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 'label'=>'Concepto'],                
            ];
    }
}
