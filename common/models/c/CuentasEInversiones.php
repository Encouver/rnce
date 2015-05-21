<?php

namespace common\models\c;

use common\models\p\PersonasJuridicas;
use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuentas.e_inversiones".
 *
 * @property integer $id
 * @property integer $empresa_relacionada_id
 * @property boolean $corriente
 * @property string $disponibilidad
 * @property string $tipo_instrumento
 * @property string $nombre_instrumento
 * @property string $motivo_retiro
 * @property integer $numero_acc_bon
 * @property integer $e_inversion_info_adicional_id
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $fecha_motivo
 * @property string $monto_nominal_motivo
 * @property string $monto_nominal_motivo_ajus
 *
 * @property CuentasEInversionesInfoAdicional $eInversionInfoAdicional
 * @property Contratistas $contratista
 * @property PersonasJuridicas $empresaRelacionada
 * @property CuentasETiposMovimientos[] $cuentasETiposMovimientos
 */
class CuentasEInversiones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.e_inversiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empresa_relacionada_id', 'corriente', 'disponibilidad', 'tipo_instrumento', 'nombre_instrumento', 'numero_acc_bon', 'e_inversion_info_adicional_id', 'contratista_id', 'anho', 'fecha_motivo', 'monto_nominal_motivo', 'monto_nominal_motivo_ajus'], 'required'],
            [['empresa_relacionada_id', 'numero_acc_bon', 'e_inversion_info_adicional_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['corriente', 'sys_status'], 'boolean'],
            [['disponibilidad', 'tipo_instrumento', 'motivo_retiro'], 'string'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_motivo'], 'safe'],
            [['monto_nominal_motivo', 'monto_nominal_motivo_ajus'], 'number'],
            [['nombre_instrumento'], 'string', 'max' => 255],
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
            'empresa_relacionada_id' => Yii::t('app', 'Empresa Relacionada ID'),
            'corriente' => Yii::t('app', 'Corriente'),
            'disponibilidad' => Yii::t('app', 'Disponibilidad'),
            'tipo_instrumento' => Yii::t('app', 'Tipo Instrumento'),
            'nombre_instrumento' => Yii::t('app', 'Nombre Instrumento'),
            'motivo_retiro' => Yii::t('app', 'Motivo Retiro'),
            'numero_acc_bon' => Yii::t('app', 'Numero Acciones / Bonos'),
            'e_inversion_info_adicional_id' => Yii::t('app', 'E Inversion Información Adicional'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'fecha_motivo' => Yii::t('app', 'Fecha Motivo'),
            'monto_nominal_motivo' => Yii::t('app', 'Monto Nominal Motivo'),
            'monto_nominal_motivo_ajus' => Yii::t('app', 'Monto Nominal Motivo Ajustado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEInversionInfoAdicional()
    {
        return $this->hasOne(CuentasEInversionesInfoAdicional::className(), ['id' => 'e_inversion_info_adicional_id']);
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
    public function getEmpresaRelacionada()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'empresa_relacionada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasETiposMovimientos()
    {
        return $this->hasMany(CuentasETiposMovimientos::className(), ['e_inversion_id' => 'id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'empresa_relacionada_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(PersonasJuridicas::find()->all(),'rif',function($model){ return $model->etiqueta();}),'options'=>['onchange'=>'']]],
            'corriente'=>['type'=>Form::INPUT_CHECKBOX,],
            'disponibilidad'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>['DISPONIBLES PARA LA VENTA'=>'DISPONIBLES PARA LA VENTA','NO DISPONIBLES PARA LA VENTA'=>'NO DISPONIBLES PARA LA VENTA', 'SUBSIDIARIAS, NEGOCIOS CONJUNTOS Y ASOCIADAS'=>'SUBSIDIARIAS, NEGOCIOS CONJUNTOS Y ASOCIADAS',],'options'=>['onchange'=>'']]],
            'tipo_instrumento'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>['BONOS'=>'BONOS','ACCIONES'=>'ACCIONES',],'options'=>['onchange'=>'']]],
            'nombre_instrumento'=>['type'=>Form::INPUT_TEXT,],
            'motivo_retiro'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>['VENTA'=>'VENTA','CESION'=>'CESION','DETERIORO'=>'DETERIORO'],'options'=>['multiple'=>false,'onchange'=>'']]],
            'fecha_motivo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(), 'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            'numero_acc_bon'=>['type'=>Form::INPUT_TEXT],//['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>['prefix'=>'','precision'=>'0'],]],
            'monto_nominal_motivo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'monto_nominal_motivo_ajus'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],


        ];
    }
}
