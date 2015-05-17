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
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class Acciones extends \common\components\BaseActiveRecord
{
    public $numero_comun_pagada;
    public $valor_comun_pagada;
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
            [['suscrito', 'documento_registrado_id','contratista_id','tipo_accion'], 'required'],
            [['numero_comun', 'numero_comun_pagada','numero_preferencial', 'documento_registrado_id','contratista_id','suscrito'], 'integer'],
            ['numero_comun_pagada', 'validarnumeropagada'],
            ['valor_comun_pagada', 'validarvalorpagada'],
          
            [['valor_comun', 'valor_preferencial','valor_comun_pagada'], 'number'],
            [['sys_status', 'suscrito'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_accion'], 'string'],
            [['numero_comun', 'valor_comun','numero_comun_pagada','valor_comun_pagada'], 'required', 'on' => 'principal']
            
        ];
    }
      public function validarnumeropagada($attribute){
          if($this->numero_comun_pagada>$this->numero_comun){
               $this->addError($attribute,'Numero Comun pagada invalido');
          } 
    }
    public function validarvalorpagada($attribute){
          if($this->valor_comun_pagada>$this->valor_comun){
               $this->addError($attribute,'Valor Comun pagada invalido');
          } 
    }
    


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_comun' => Yii::t('app', 'Numero Accion o Participacion Suscrita'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'valor_comun' => Yii::t('app', 'Valor Accion o Participacion Suscrita'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_accion' => Yii::t('app', 'Tipo Accion'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'contratista_id' => Yii::t('app', 'COntratista'),
            'numero_comun_pagada' => Yii::t('app', 'Numero Accion o Participacion Pagada'),
            'valor_comun_pagada' => Yii::t('app', 'Valor Accion o Participacion Pagada'),
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
            'numero_comun_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de acciones o participaciones']],
            'valor_comun_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
          
      
    ];
    
    
    }
}
