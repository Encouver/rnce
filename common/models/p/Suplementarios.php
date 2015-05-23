<?php

namespace common\models\p;
use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "suplementarios".
 *
 * @property integer $id
 * @property integer $numero
 * @property string $valor
 * @property string $tipo_suplementario
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
class Suplementarios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $numero_pagada;
    public $capital_pagado;
    public static function tableName()
    {
        return 'suplementarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero','numero_pagada', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id'], 'integer'],
            [['valor','capital','capital_pagado'], 'number'],
            [['tipo_suplementario'], 'string'],
            ['numero_pagada', 'validarnumeropagada'],
            ['capital', 'validarcapital'],
            ['capital_pagado', 'validarcapitalpagado'],
            ['valor', 'validarvalor'],
            [['capital','capital_pagado','numero', 'valor','numero_pagada'], 'required', 'on' => 'principal'],
            [['suscrito', 'documento_registrado_id', 'contratista_id'], 'required'],
            [['suscrito', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }
    public function validarcapital($attribute){
         
              if($this->numero*$this->valor< $this->capital){
                  $this->addError($attribute,'Faltan capital por fraccionar');
              }
          
    }
   
      public function validarnumeropagada($attribute){
          if($this->numero_pagada>$this->numero){
               $this->addError($attribute,'Numero certificado suplementario pagado invalido');
          }else{
             if($this->numero_pagada * $this->valor >$this->numero){
                  $this->addError($attribute,'Numero certificado suplementario pagado sobrepasa el valor valido');
             }
          }
    }
    public function validarcapitalpagado($attribute){
          if($this->capital_pagado>$this->capital){
               $this->addError($attribute,'Valor certificado suplementario pagado invalido');
          }else{
              if($this->numero_pagada*$this->valor< $this->capital_pagado){
                  $this->addError($attribute,'Faltan certificado suplementario pagado por fraccionar');
              }
          }
    }
    public function validarvalor($attribute){
          if($this->valor*$this->numero > $this->capital){
               $this->addError($attribute,'Valor certificado suscrito invalida');
          } 
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero' => Yii::t('app', 'Numero'),
            'valor' => Yii::t('app', 'Valor'),
            'tipo_suplementario' => Yii::t('app', 'Tipo Suplementario'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'numero_pagada' => Yii::t('app', 'Numero Pagada'),
            'capital' => Yii::t('app', 'Capital Suscrito'),
            'capital_pagado' => Yii::t('app', 'Capital Pagado'),
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
               'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios']],
               'valor'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
            'capital_pagado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Pagado']],
               
             'numero_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados Suplementarios']],
          
              
            ];
        
        }
        return false;
    }
}
