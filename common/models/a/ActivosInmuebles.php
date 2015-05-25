<?php

namespace common\models\a;

use kartik\builder\Form;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activos.inmuebles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $descripcion
 * @property string $direccion_ubicacion
 * @property string $ficha_catastral
 * @property string $zonificacion
 * @property string $extension
 * @property string $titulo_supletorio
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 */
class ActivosInmuebles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.inmuebles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'direccion_ubicacion', 'ficha_catastral', 'zonificacion', 'extension'], 'required'],
            [['bien_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['descripcion'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['direccion_ubicacion', 'ficha_catastral', 'zonificacion', 'extension', 'titulo_supletorio'], 'string', 'max' => 255],
            [['bien_id'], 'unique']
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
            'descripcion' => Yii::t('app', 'Descripcion'),
            'direccion_ubicacion' => Yii::t('app', 'Direccion Ubicacion'),
            'ficha_catastral' => Yii::t('app', 'Ficha Catastral'),
            'zonificacion' => Yii::t('app', 'Zonificacion'),
            'extension' => Yii::t('app', 'Extension'),
            'titulo_supletorio' => Yii::t('app', 'Titulo Supletorio'),
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
    public function getBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
    }

    public function getFormAttribs($model) {
        $formAttribs =  [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'descripcion'=>['type'=>Form::INPUT_TEXT,],
            'direccion_ubicacion'=>['type'=>Form::INPUT_TEXT,],
            'ficha_catastral'=>['type'=>Form::INPUT_TEXT,],
            'zonificacion'=>['type'=>Form::INPUT_TEXT,],
            'extension'=>['type'=>Form::INPUT_TEXT,],
            //'titulo_supletorio'=>isset($model) && $model->sys_tipo_bien_id == 9?['type'=>Form::INPUT_TEXT,'label'=>'hola']:[],
            /*'sys_tipo_bien_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposBienes::find()->asArray()->all(),'id','nombre',function($model){ return ActivosSysTiposBienes::findOne($model['sys_clasificacion_bien_id'])->sysClasificacionBien->nombre;}),]],

            'depreciable'=>['type'=>Form::INPUT_CHECKBOX,],
            'deterioro'=>['type'=>Form::INPUT_CHECKBOX,],
            'detalle'=>['type'=>Form::INPUT_TEXT,],
            'origen'=>['type'=>Form::INPUT_TEXT,],
            'propio'=>['type'=>Form::INPUT_CHECKBOX,],
            'fecha_origen'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],*/
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],

        ];

        if(isset($model) && $model->sys_tipo_bien_id == 2)
            $formAttribs['titulo_supletorio'] =['type'=>Form::INPUT_TEXT,];
        return $formAttribs;
    }
}
