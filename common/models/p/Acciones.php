<?php

namespace common\models\p;
use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "acciones".
 *
 * @property integer $id
 * @property integer $numero_comun
 * @property integer $numero_preferencial
 * @property string $valor_comun
 * @property string $valor_preferencial
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_accion
 * @property boolean $suscrito
 * @property integer $acta_constitutiva_id
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class Acciones extends \common\components\BaseActiveRecord
{
    public $numero_comun_pagado;
    public $valor_comun_pagado;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_comun', 'numero_preferencial', 'acta_constitutiva_id'], 'integer'],
            [['valor_comun', 'valor_preferencial'], 'number'],
            [['sys_status', 'suscrito'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_accion'], 'string'],
            [['suscrito', 'acta_constitutiva_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_comun' => Yii::t('app', 'Numero Accion o Participacion'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'valor_comun' => Yii::t('app', 'Valor Accion o Participacion'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_accion' => Yii::t('app', 'Tipo Accion'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }
    
     public function getFormAttribsactas() {
      
        
       
    return [
            'numero_comun'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de acciones o participaciones']],
            'valor_comun'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
          
      
    ];
    
    
    }
}
