<?php

namespace common\models\p;
use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "certificados".
 *
 * @property integer $id
 * @property integer $numero_asociacion
 * @property integer $numero_aportacion
 * @property integer $numero_rotativo
 * @property integer $numero_inversion
 * @property string $valor_asociacion
 * @property string $valor_aportacion
 * @property string $valor_rotativo
 * @property string $valor_inversion
 * @property string $tipo_certificado
 * @property boolean $suscrito
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class Certificados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $numero_asociacion_pagada;
    public $numero_aportacion_pagada;
    public $numero_rotativo_pagada;
    public $numero_inversion_pagada;
    public $capital_pagado;

    public static function tableName()
    {
        return 'certificados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id'], 'integer'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion','capital','capital_pagado'], 'number'],
            [['tipo_certificado'], 'string'],
            ['numero_asociacion_pagada', 'validarnumeroasociacionpagada'],
            ['valor_asociacion_pagada', 'validarvalorasociacionpagada'],
            ['numero_aportacion_pagada', 'validarnumeroaportacionpagada'],
            ['valor_aportacion_pagada', 'validarvaloraportacionpagada'],
            ['numero_rotativo_pagada', 'validarnumerorotativopagada'],
            ['valor_rotativo_pagada', 'validarvalorrotativopagada'],
            ['numero_inversion_pagada', 'validarnumeroinversionpagada'],
            ['valor_inversion_pagada', 'validarvalorinversionpagada'],
            [['capital','numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'valor_asociacion', 'valor_aportacion', 'valor_rotativo','valor_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'capital_pagado'], 'required','on'=>'principal'],
            [['suscrito', 'documento_registrado_id', 'contratista_id'], 'required'],
            [['suscrito', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }
     public function validarnumeroasociacionpagada($attribute){
          if($this->numero_asociacion_pagada>$this->numero_asociacion){
               $this->addError($attribute,'Numero Asociacion pagada invalido');
          } 
    }
    public function validarvalorasociacionpagada($attribute){
          if($this->valor_asociacion_pagada>$this->valor_asociacion){
               $this->addError($attribute,'Valor Asociacion pagada invalido');
          } 
    }
    public function validarnumeroaportacionpagada($attribute){
          if($this->numero_aportacion_pagada>$this->numero_aportacion){
               $this->addError($attribute,'Numero Aportacion pagada invalido');
          } 
    }
    public function validarvaloraportacionpagada($attribute){
          if($this->valor_aportacion_pagada>$this->valor_aportacion){
               $this->addError($attribute,'Valor Aportacion pagada invalido');
          } 
    }
    public function validarnumerorotativopagada($attribute){
          if($this->numero_rotativo_pagada>$this->numero_rotativo){
               $this->addError($attribute,'Numero Rotativo pagada invalido');
          } 
    }
    public function validarvalorrotativopagada($attribute){
          if($this->valor_rotativo_pagada>$this->valor_rotativo){
               $this->addError($attribute,'Valor rotativo pagada invalido');
          } 
    }
            
     public function validarnumeroinversionpagada($attribute){
          if($this->numero_inversion_pagada>$this->numero_inversion){
               $this->addError($attribute,'Numero Inversion pagada invalido');
          } 
    }
    public function validarvalorinversionpagada($attribute){
          if($this->valor_inversion_pagada>$this->valor_inversion){
               $this->addError($attribute,'Valor Inversion pagada invalido');
          } 
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_asociacion' => Yii::t('app', 'Numero Asociacion'),
            'numero_aportacion' => Yii::t('app', 'Numero Aportacion'),
            'numero_rotativo' => Yii::t('app', 'Numero Rotativo'),
            'numero_inversion' => Yii::t('app', 'Numero Inversion'),
            'valor_asociacion' => Yii::t('app', 'Valor Asociacion'),
            'valor_aportacion' => Yii::t('app', 'Valor Aportacion'),
            'valor_rotativo' => Yii::t('app', 'Valor Rotativo'),
            'valor_inversion' => Yii::t('app', 'Valor Inversion'),
            'tipo_certificado' => Yii::t('app', 'Tipo Certificado'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'numero_asociacion_pagada' => Yii::t('app', 'Numero Asociacion Pagada'),
            'numero_aportacion_pagada' => Yii::t('app', 'Numero Aportacion Pagada'),
            'numero_rotativo_pagada' => Yii::t('app', 'Numero Rotativo Pagada'),
            'numero_inversion_pagada' => Yii::t('app', 'Numero Inversion Pagada'),
            'capital' => Yii::t('app', 'Capital Suscrito'),
            'capital_pagado' => Yii::t('app', 'Capital pagado'),
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    
     public function getFormAttribs($id) {
        
        if($id=='principal')
        {
            

            return [
               'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito']],
               'numero_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'capital_pagado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Pagado']],
               'numero_asociacion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_aportacion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_rotativo_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_inversion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
              
            ];
        
        }
        return false;
    }
}
