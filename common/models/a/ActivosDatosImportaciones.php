<?php

namespace common\models\a;

use common\models\p\SysDivisas;
use common\models\p\SysPaises;
use kartik\builder\Form;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activos.datos_importaciones".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $num_guia_nac
 * @property string $costo_adquisicion
 * @property string $gastos_mon_extranjera
 * @property integer $sys_divisa_id
 * @property string $tasa_cambio
 * @property string $gastos_imp_nacional
 * @property string $otros_costros_imp_instalacion
 * @property string $total_costo_adquisicion
 * @property integer $pais_origen_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 * @property SysDivisas $sysDivisa
 * @property SysPaises $paisOrigen
 */
class ActivosDatosImportaciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.datos_importaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'num_guia_nac', 'costo_adquisicion', 'gastos_mon_extranjera', 'sys_divisa_id', 'tasa_cambio', 'gastos_imp_nacional', 'otros_costros_imp_instalacion', 'total_costo_adquisicion', 'pais_origen_id'], 'required',
                'when' => function ($model) {
                return !$model->bien->nacional;
            }, 'whenClient' => "function (attribute, value) {
                    return !$('#activosbienes-nacional').is(':checked');
                }"],
            [['bien_id', 'sys_divisa_id', 'pais_origen_id'], 'integer'],
            [['costo_adquisicion', 'gastos_mon_extranjera', 'tasa_cambio', 'gastos_imp_nacional', 'otros_costros_imp_instalacion', 'total_costo_adquisicion'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_guia_nac'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            //'bien_id' => Yii::t('app', 'Bien'),
            'num_guia_nac' => Yii::t('app', 'Número de guía o documento de Nacionalización'),
            'costo_adquisicion' => Yii::t('app', 'Costo de Adquisición (en Bs)'),
            'gastos_mon_extranjera' => Yii::t('app', 'Gasto de Importación en Moneda Extranjera'),
            'sys_divisa_id' => Yii::t('app', 'Moneda de Adquisición'),
            'tasa_cambio' => Yii::t('app', 'Tasa de cambio'),
            'gastos_imp_nacional' => Yii::t('app', 'Gastos de Importación Nacionales'),
            'otros_costros_imp_instalacion' => Yii::t('app', 'Otros Costos generados producto de la Importación / Instalación'),
            'total_costo_adquisicion' => Yii::t('app', 'Total Costo de Adquisición (En Bs.):'),
            'pais_origen_id' => Yii::t('app', 'País de Origen'),
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
    public function getSysDivisa()
    {
        return $this->hasOne(SysDivisas::className(), ['id' => 'sys_divisa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisOrigen()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'pais_origen_id']);
    }

    public function getFormAttribs() {
        $attributes = [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],

            'num_guia_nac'=>['type'=>Form::INPUT_TEXT,],
            'costo_adquisicion'=>['type'=>Form::INPUT_TEXT,],
            'gastos_mon_extranjera'=>['type'=>Form::INPUT_TEXT,],
            'sys_divisa_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(SysDivisas::find()->all(),'id','nombre'),'options'=>[]]],
            'tasa_cambio'=>['type'=>Form::INPUT_TEXT,],
            'gastos_imp_nacional'=>['type'=>Form::INPUT_TEXT,],
            'otros_costros_imp_instalacion'=>['type'=>Form::INPUT_TEXT,],
            'total_costo_adquisicion'=>['type'=>Form::INPUT_TEXT,],
            'pais_origen_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),'options'=>[]]],




/*            //'depreciable'=>['type'=>Form::INPUT_CHECKBOX,],
            //'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],
            'detalle'=>['type'=>Form::INPUT_TEXT,],
            'origen_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysOrigenesBienes::find()->asArray()->all(),'id','nombre'),'options'=>['id'=>'origen','onchange'=>'js: this.form.submit();']]],
            'propio'=>['type'=>Form::INPUT_CHECKBOX,],
            //'principio_contable_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysFormasOrg::find()->asArray()->all(),'id','nombre')]],
            'fecha_origen'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>true]
            ],
            //'nacional'=>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true]],
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],*/

        ];


        return $attributes;
    }

}
