<?php

namespace common\models\p;
use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "public.contratos_valuaciones".
 *
 * @property integer $id
 * @property integer $relacion_contrato_id
 * @property integer $orden_valuacion
 * @property string $monto
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
        return 'public.contratos_valuaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relacion_contrato_id', 'orden_valuacion', 'monto'], 'required'],
            [['relacion_contrato_id', 'orden_valuacion'], 'integer'],
            [['monto'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
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
    
      
    return [
          
        'orden_valuacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Orden de la valuacion']],
        'monto'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Monto de la valuacion']],
       
      
    ];
    
    
    }
}
