<?php

namespace common\models\a;

use kartik\builder\Form;
use kartik\widgets\DatePicker;
use Yii;

/**
 * This is the model class for table "activos.activos_intangibles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $certificado_registro
 * @property string $fecha_registro
 * @property string $vigencia
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 * @property ActivosLicencias[] $activosLicencias
 */
class ActivosActivosIntangibles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.activos_intangibles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'vigencia'], 'required'],
            [['bien_id'], 'integer'],
            [['fecha_registro', 'vigencia', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['certificado_registro'], 'string', 'max' => 255]
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
            'certificado_registro' => Yii::t('app', 'Certificado Registro'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'vigencia' => Yii::t('app', 'Vigencia'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosLicencias()
    {
        return $this->hasMany(ActivosLicencias::className(), ['activo_intangible_id' => 'id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'certificado_registro'=>['type'=>Form::INPUT_TEXT,],
            'fecha_registro'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            'vigencia'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],

        ];
    }
}
