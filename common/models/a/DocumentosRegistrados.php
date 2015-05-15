<?php

namespace common\models\a;
use common\models\p\SysCircunscripciones;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "activos.documentos_registrados".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $sys_tipo_registro_id
 * @property string $sys_circunscripcion_id
 * @property string $num_registro_notaria
 * @property string $tomo
 * @property string $folio
 * @property string $fecha_registro
 * @property string $fecha_asamblea
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property SysTiposRegistros $sysTipoRegistro
 */
class DocumentosRegistrados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.documentos_registrados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'sys_tipo_registro_id', 'sys_circunscripcion_id', 'num_registro_notaria', 'tomo', 'folio', 'fecha_registro'], 'required'],
            [['contratista_id', 'sys_tipo_registro_id','sys_circunscripcion_id'], 'integer'],
            [['fecha_registro', 'fecha_asamblea', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['num_registro_notaria'], 'string', 'max' => 255],
            [['tomo', 'folio'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_tipo_registro_id' => Yii::t('app', 'Sys Tipo Registro ID'),
            'sys_circunscripcion_id' => Yii::t('app', 'Circunscripcion'),
            'num_registro_notaria' => Yii::t('app', 'Numero de Registro Notaria'),
            'tomo' => Yii::t('app', 'Tomo'),
            'folio' => Yii::t('app', 'Folio'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_asamblea' => Yii::t('app', 'Fecha Asamblea'),
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
    public function getSysTipoRegistro()
    {
        return $this->hasOne(SysTiposRegistros::className(), ['id' => 'sys_tipo_registro_id']);
    }
    
    
     public function getFormAttribs() {
      
        
       
    return [
           'sys_circunscripcion_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysCircunscripciones::find()->all(),'id','nombre') , 'options'=>['prompt'=>'Seleccione circunscripcion']],
            'num_registro_notaria'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
            'tomo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
            'folio'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
            'fecha_registro'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ], 
            'fecha_asamblea'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                ],
      
    ];
    
    
    }
    
}
