<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\p\RelacionesContratos;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "contratos_valuaciones".
 *
 * @property integer $id
 * @property integer $relacion_contrato_id
 * @property integer $orden_valuacion
 * @property string $monto
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property RelacionesContratos $relacionContrato
 */
class ContratosValuaciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contratos_valuaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relacion_contrato_id', 'orden_valuacion', 'monto'], 'required'],
            [['relacion_contrato_id', 'orden_valuacion', 'creado_por', 'actualizado_por'], 'integer'],
            [['monto'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['orden_valuacion'], 'unique', 'targetAttribute' => ['relacion_contrato_id', 'orden_valuacion'], 'message' => 'Ya se encuentra cargado un registro con este orden de valuacion.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'relacion_contrato_id' => Yii::t('app', 'Relacion Contrato ID'),
            'orden_valuacion' => Yii::t('app', 'Orden Valuacion'),
            'monto' => Yii::t('app', 'Monto'),
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
    public function getRelacionContrato()
    {
        return $this->hasOne(RelacionesContratos::className(), ['id' => 'relacion_contrato_id']);
    }
    public function getFormAttribs() {
    
     $contrato = empty($this->relacion_contrato_id) ? '' : RelacionesContratos::findOne($this->relacion_contrato_id)->nombre_proyecto;
    return [
        
           'relacion_contrato_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'initValueText' => $contrato,
                'options'=>['placeholder' => 'Buscar proyecto'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['relaciones-contratos/relaciones-contratos-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term,ver:"valuacion"}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(relacion_contrato_id) { return relacion_contrato_id.text; }'),
                'templateSelection' => new JsExpression('function (relacion_contrato_id) { return relacion_contrato_id.text; }'),
            ],]],
          
        'orden_valuacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Orden factura']],
        'monto'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Monto']],
      
    ];
    
    
    }
}
