<?php

namespace common\models\a;

use common\models\p\PersonasJuridicas;
use common\models\p\PersonasNaturales;
use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activos.avaluos".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $valor
 * @property string $fecha_informe
 * @property integer $perito_id
 * @property integer $gremio_id
 * @property string $num_inscripcion_gremio
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 * @property ActivosSysGremios $gremio
 * @property PersonasNaturales $perito
 */
class ActivosAvaluos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.avaluos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'valor', 'fecha_informe', 'perito_id', 'gremio_id', 'num_inscripcion_gremio'], 'required'],
            [['bien_id', 'perito_id', 'gremio_id'], 'integer'],
            [['valor'], 'number'],
            [['fecha_informe', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['num_inscripcion_gremio'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien'),
            'valor' => Yii::t('app', 'Valor según avaluo'),
            'fecha_informe' => Yii::t('app', 'Fecha de Informe'),
            'perito_id' => Yii::t('app', 'Perito'),
            'gremio_id' => Yii::t('app', 'Gremio'),
            'num_inscripcion_gremio' => Yii::t('app', 'Número de Inscripción del Gremio'),
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
    public function getGremio()
    {
        return $this->hasOne(ActivosSysGremios::className(), ['id' => 'gremio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerito()
    {
        return $this->hasOne(PersonasNaturales::className(), ['id' => 'perito_id']);
    }


    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosBienes::find()->all(),'id','detalle',function($model){ return $model->sysTipoBien->nombre;}), ]],

            'valor'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),'options'=>['pluginOptions'=>['prefix'=>'','precision'=>'0'],]],
            'fecha_informe'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>false]
            ],
            'perito_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(PersonasNaturales::find()->all(),'id',function($model){return $model->etiqueta();}), ]],
            'gremio_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysGremios::find()->all(),'id',function($model){return $model->etiqueta();}), ]],
            'num_inscripcion_gremio'=>['type'=>Form::INPUT_TEXT,],

        ];
    }
}
