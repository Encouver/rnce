<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\CertificacionesAportes;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use common\models\p\DenominacionesComerciales;
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
 * @property string $fecha_informe
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
 * @property integer $certificacion_aporte_id
 * @property boolean $actual
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
            [['numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id','certificacion_aporte_id'], 'integer'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion','capital','capital_pagado'], 'number'],
            [['tipo_certificado'], 'string'],
            ['capital', 'validarcapital'],
            ['capital_pagado', 'validarcapitalpagado'],
            ['valor_asociacion', 'validarmaximoasociacion'],
            ['valor_aportacion', 'validarmaximoaportacion'],
            ['valor_inversion', 'validarmaximoinversion'],
            ['valor_rotativo', 'validarmaximorotativo'],
            ['numero_asociacion_pagada', 'validarnumeroasociacionpagada'],
            ['numero_aportacion_pagada', 'validarnumeroaportacionpagada'],
            ['numero_rotativo_pagada', 'validarnumerorotativopagada'],
            ['numero_inversion_pagada', 'validarnumeroinversionpagada'],
            ['numero_asociacion', 'validarnumeroasociacion'],
            ['numero_aportacion', 'validarnumeroaportacion'],
            ['numero_rotativo', 'validarnumerorotativo'],
            ['numero_inversion', 'validarnumeroinversion'],
            ['total_venta', 'validarventa'],
            [['total_venta','numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'valor_asociacion', 'valor_aportacion', 'valor_rotativo','valor_inversion'], 'required', 'on' => 'venta'],
            [['capital','numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'valor_asociacion', 'valor_aportacion', 'valor_rotativo','valor_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'capital_pagado','certificacion_aporte_id','fecha_informe'], 'required','on'=>'aumento'],
            [['capital','numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'valor_asociacion', 'valor_aportacion', 'valor_rotativo','valor_inversion','numero_asociacion_pagada', 'numero_aportacion_pagada', 'numero_rotativo_pagada', 'numero_inversion_pagada', 'capital_pagado','certificacion_aporte_id','fecha_informe'], 'required','on'=>'principal'],
            [['capital','numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion','certificacion_aporte_id','fecha_informe'], 'required','on'=>'pago'],
            [['suscrito', 'documento_registrado_id', 'contratista_id'], 'required'],
            [['suscrito', 'sys_status','actual'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el','fecha_informe'], 'safe'],
           
        ];
    }
    public function validarcapital($attribute){
         
             
              
       if($this->scenario=='principal' || $this->scenario=='aumento'){
               if(($this->numero_asociacion*$this->valor_asociacion)+($this->numero_aportacion*$this->valor_aportacion)+($this->numero_rotativo*$this->valor_rotativo)+($this->numero_inversion*$this->valor_inversion) < $this->capital){
                  $this->addError($attribute,'Faltan capital por fraccionar');
              }
          }else{
              if($this->scenario=='pago'){
                  $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
                  if(isset($acta)){
                      //$accion= Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
                      $monto=$acta->capital_suscrito-$acta->capital_pagado;
                      if($this->capital>$monto){
                        $this->addError($attribute,'Monto sobre pasa el capital deudor actual:'.$monto);
                        }else{
                                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                                 if(($this->numero_asociacion*$certificado->valor_asociacion)+($this->numero_aportacion*$certificado->valor_aportacion)+($this->numero_rotativo*$certificado->valor_rotativo)+($this->numero_inversion*$certificado->valor_inversion) < $this->capital){
                                    $this->addError($attribute,'Falta capital por fraccionar');
                                }
                        }
                      
                  }
              }
          }
          
    }
     public function validarnumeroasociacion($attribute){
           if($this->scenario=='pago'){
               $certificado_suscrito= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                $certificado_pagado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>false]);
          if(($this->numero_asociacion+ $certificado_pagado->numero_asociacion)>$certificado_suscrito->numero_asociacion){
               $this->addError($attribute,'El numero de asociacion pagada sobrepasa los certificados suscritos:'.$certificado_suscrito->numero_asociacion);
          }else{
             if(($this->numero_asociacion*$certificado_suscrito->valor_asociacion) >$this->capital){
                  $this->addError($attribute,'Numero de asociaciones pagadas por el valor de asociaciones suscritas sobrepasa el capital pagado');
             }
          }
        }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->numero_asociacion>$certificado->numero_asociacion){
                   $this->addError($attribute,'Numero de certificados sobrepasa el valor valido: '.$certificado->numero_asociacion);
                }
            }
            
        }

    }
    public function validarnumeroaportacion($attribute){
           if($this->scenario=='pago'){
               $certificado_suscrito= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                $certificado_pagado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>false]);
          if(($this->numero_aportacion+ $certificado_pagado->numero_aportacion)>$certificado_suscrito->numero_aportacion){
               $this->addError($attribute,'El numero de aportacion pagada sobrepasa los certificados suscritos:'.$certificado_suscrito->numero_aportacion);
          }else{
             if(($this->numero_aportacion*$certificado_suscrito->valor_aportacion) >$this->capital){
                  $this->addError($attribute,'Numero de aportaciones pagadas por el valor de aportaciones suscritas sobrepasa el capital pagado');
             }
          }
         }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->numero_aportacion>$certificado->numero_aportacion){
                     $this->addError($attribute,'Numero de certificados sobrepasa el valor valido: '.$certificado->numero_aportacion);
                }
            }
            
        }

    }
    public function validarnumerorotativo($attribute){
           if($this->scenario=='pago'){
               $certificado_suscrito= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                $certificado_pagado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>false]);
          if(($this->numero_rotativo+ $certificado_pagado->numero_rotativo)>$certificado_suscrito->numero_rotativo){
               $this->addError($attribute,'El numero de rotativo pagado sobrepasa los certificados suscritos:'.$certificado_suscrito->numero_rotativo);
          }else{
             if(($this->numero_rotativo*$certificado_suscrito->valor_rotativo) >$this->capital){
                  $this->addError($attribute,'Numero de rotativo pagados por el valor de rotativos suscritos sobrepasa el capital pagado');
             }
          }
         }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->numero_rotativo>$certificado->numero_rotativo){
                     $this->addError($attribute,'Numero de certificados sobrepasa el valor valido: '.$certificado->numero_rotativo);
                }
            }
            
        }

    }
     public function validarnumeroinversion($attribute){
           if($this->scenario=='pago'){
               $certificado_suscrito= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>true]);
                $certificado_pagado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true,'suscrito'=>false]);
          if(($this->numero_inversion+ $certificado_pagado->numero_inversion)>$certificado_suscrito->numero_inversion){
               $this->addError($attribute,'El numero de inversion pagado sobrepasa los certificados suscritos:'.$certificado_suscrito->numero_inversion);
          }else{
             if(($this->numero_inversion*$certificado_suscrito->valor_inversion) >$this->capital){
                  $this->addError($attribute,'Numero de inversion pagados por el valor de inversiones suscritas sobrepasa el capital pagado');
             }
          }
         }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->numero_inversion>$certificado->numero_inversion){
                     $this->addError($attribute,'Numero de certificados sobrepasa el valor valido: '.$certificado->numero_inversion);
                }
            }
            
        }

    }
      public function validarcapitalpagado($attribute){
          if($this->scenario=='principal' || $this->scenario=='aumento'){
               if($this->capital_pagado>$this->capital){
               $this->addError($attribute,'Valor Capital pagada invalido');
            }else{
              if(($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion)+($this->numero_rotativo_pagada*$this->valor_rotativo)+($this->numero_inversion_pagada*$this->valor_inversion) < $this->capital_pagado){
                  $this->addError($attribute,'Faltan capital pagado por fraccionar');
              }
            }
          }
         
    }
    public function validarmaximoasociacion($attribute){
        if($this->scenario=='principal' || $this->scenario=='aumento'){
             if($this->valor_asociacion*$this->numero_asociacion > $this->capital){
               $this->addError($attribute,'Valor Asociacion pasa el maximo valido');
          } 
        }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->valor_asociacion!=$certificado->valor_asociacion){
                    $this->addError($attribute,'Valor de venta de certificados invalido:'.$this->valor_asociacion.' de '.$certificado->valor_asociacion);
                }
            }
            
        }
        
         
    }
    public function validarmaximoaportacion($attribute){
        if($this->scenario=='principal' || $this->scenario=='aumento'){
             if(($this->valor_asociacion*$this->numero_asociacion)+($this->valor_aportacion*$this->numero_aportacion)> $this->capital){
               $this->addError($attribute,'Valor Inversion pasa el maximo valido');
          } 
        }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->valor_aportacion!=$certificado->valor_aportacion){
                    $this->addError($attribute,'Valor de venta de certificados invalido:'.$this->valor_aportacion.' de '.$certificado->valor_aportacion);
                }
            }
            
        }
         
    }
    public function validarmaximoinversion($attribute){
        if($this->scenario=='principal' || $this->scenario=='aumento'){
            if(($this->valor_asociacion*$this->numero_asociacion)+($this->valor_aportacion*$this->numero_aportacion) +($this->valor_inversion*$this->numero_inversion) > $this->capital){
               $this->addError($attribute,'Valor Aportacion pasa el maximo valido');
          } 
        }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->valor_inversion!=$certificado->valor_inversion){
                    $this->addError($attribute,'Valor de venta de certificados invalido:'.$this->valor_inversion.' de '.$certificado->valor_inversion);
                }
            }
            
        }
          
    }
     public function validarmaximorotativo($attribute){
        if($this->scenario=='principal' || $this->scenario=='aumento'){
            if(($this->valor_asociacion*$this->numero_asociacion)+($this->valor_aportacion*$this->numero_aportacion) +($this->valor_inversion*$this->numero_inversion) +($this->valor_rotativo*$this->numero_rotativo)> $this->capital){
               $this->addError($attribute,'Valor Rotativo pasa el maximo valido');
          } 
        }else{
            if($this->scenario=='venta'){
                $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                if($this->valor_rotativo!=$certificado->valor_rotativo){
                    $this->addError($attribute,'Valor de venta de certificados invalido:'.$this->valor_rotativo.' de '.$certificado->valor_rotativo);
                }
            }
            
        }
          
    }
     public function validarnumeroasociacionpagada($attribute){
         if($this->scenario=='principal' || $this->scenario=='aumento'){
             if($this->numero_asociacion_pagada>$this->numero_asociacion){
               $this->addError($attribute,'Numero Asociacion pagada invalido');
          }else{
              if(($this->capital_pagado<$this->capital) && ($this->numero_asociacion_pagada*$this->valor_asociacion > $this->capital_pagado)){
               $this->addError($attribute,'Numero Asociacion pagada sobrepasa valor valido');
            } 
          }
         }
          
    }
    
    
    public function validarnumeroaportacionpagada($attribute){
        if($this->scenario=='principal' || $this->scenario=='aumento'){
           if($this->numero_aportacion_pagada>$this->numero_aportacion){
               $this->addError($attribute,'Numero Aportacion pagada invalido');
          }else{
               if(($this->capital_pagado<$this->capital) && (($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion) > $this->capital_pagado)){
               $this->addError($attribute,'Numero Aportacion pagada sobrepasa valor valido');
                } 
          } 
        }
          
    }
     
  
   
    public function validarnumerorotativopagada($attribute){
        if($this->scenario=='principal' || $this->scenario=='aumento'){
            if($this->numero_rotativo_pagada>$this->numero_rotativo){
               $this->addError($attribute,'Numero Rotativo pagada invalido');
          }else{
               if(($this->capital_pagado<$this->capital) && (($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion)+($this->numero_rotativo_pagada*$this->valor_rotativo) > $this->capital_pagado)){
               $this->addError($attribute,'Numero Rotativo pagada sobrepasa valor valido');
                }
          }
        }
          
    }
   
            
     public function validarnumeroinversionpagada($attribute){
         if($this->scenario=='principal' || $this->scenario=='aumento'){
            if($this->numero_inversion_pagada>$this->numero_inversion){
               $this->addError($attribute,'Numero Inversion pagada invalido');
          }else{
              if(($this->capital_pagado<$this->capital) && (($this->numero_asociacion_pagada*$this->valor_asociacion)+($this->numero_aportacion_pagada*$this->valor_aportacion)+($this->numero_rotativo_pagada*$this->valor_rotativo)+($this->numero_inversion_pagada*$this->valor_inversion) > $this->capital_pagado)){
               $this->addError($attribute,'Numero Inversion pagada sobrepasa valor valido');
            } 
          } 
         }
          
    }
     public function validarventa($attribute){
       
          if(($this->numero_asociacion*$this->valor_asociacion)+($this->numero_aportacion*$this->valor_aportacion)+($this->numero_rotativo*$this->valor_rotativo)+($this->numero_inversion*$this->valor_inversion)!=$this->total_venta){
               $this->addError($attribute,'Calculo erroneo en el total de venta');
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
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'numero_asociacion_pagada' => Yii::t('app', 'Numero Asociacion Pagada'),
            'numero_aportacion_pagada' => Yii::t('app', 'Numero Aportacion Pagada'),
            'numero_rotativo_pagada' => Yii::t('app', 'Numero Rotativo Pagada'),
            'numero_inversion_pagada' => Yii::t('app', 'Numero Inversion Pagada'),
            'capital' => Yii::t('app', 'Capital Suscrito'),
            'capital_pagado' => Yii::t('app', 'Capital pagado'),
            'certificacion_aporte_id'  => Yii::t('app', 'Certificador de aportes'),
            'actual'  => Yii::t('app', 'Actual'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
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
    public function getCertificacionAporte()
    {
        return $this->hasOne(CertificacionesAportes::className(), ['id' => 'certificacion_aporte_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    
    
     public function getFormAttribs() {
         $persona = empty($this->certificacion_aporte_id) ? '' : CertificacionesAportes::findOne($this->certificacion_aporte_id)->getNombreJuridica();
        if($this->scenario=='principal' || $this->scenario=='aumento')
        {
            

            return [
               'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito']],
               'numero_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
              
               'numero_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
                'numero_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
                'capital_pagado'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Pagado']],
               'numero_asociacion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_aportacion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_rotativo_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'numero_inversion_pagada'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
                'certificacion_aporte_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
               'initValueText' => $persona,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['certificaciones-aportes/certificaciones-aportes-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(certificacion_aporte_id) { return certificacion_aporte_id.text; }'),
                'templateSelection' => new JsExpression('function (certificacion_aporte_id) { return certificacion_aporte_id.text; }'),
                ],]],
                'fecha_informe'=>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DatePicker', 
                    'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                    ]],
                ],
            ];
        
        }
        if($this->scenario=='pago')
        {
            

            return [
               'capital'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Capital Suscrito'],'label'=>'Capital pagado'],
               'numero_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados '],'label'=>'Numero Asociacion pagada'],
               'numero_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados '],'label'=>'Numero Aportacion pagada'],
               'numero_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados '],'label'=>'Numero Inversion pagado'],
               'numero_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados '],'label'=>'Numero Rotativo pagado'],
               'certificacion_aporte_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
               'initValueText' => $persona,
                'options'=>['placeholder' => 'Buscar persona ...'],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['certificaciones-aportes/certificaciones-aportes-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(certificacion_aporte_id) { return certificacion_aporte_id.text; }'),
                'templateSelection' => new JsExpression('function (certificacion_aporte_id) { return certificacion_aporte_id.text; }'),
                ],]],
                'fecha_informe'=>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DatePicker', 
                    'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                    ]],
                ],
            ];
        
        }
        if($this->scenario=='venta')
        {
            

            return [
               
               'numero_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_asociacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
               'numero_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_aportacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
              
               'numero_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_inversion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
                'numero_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de Certificados ']],
               'valor_rotativo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Valor']],
                'total_venta'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Total venta']],
            ];
        
        }
    }
    public function Pagocompleto(){
       $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
        if(isset($acta)){
                 if($acta->capital_suscrito==$acta->capital_pagado){
                     return true;
                     
                 }else{
                     $modificacion=$this->Modificacionactual();
                     if(isset($modificacion)){
                        if($modificacion->pago_capital){
                            $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$modificacion->documento_registrado_id,'tipo_certificado'=>'PAGO_CAPITAL']);
                            if(isset($certificado)){
                                if(($certificado->capital + $acta->capital_pagado)==$acta->capital_suscrito){
                                    return true;
                                }
                                
                            }
                        }
                         
                     }
                 }   
                      
        }
        return false;       
       
    }
     public function Modificacionactual(){
       
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       
       if(isset($registro)){
         $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);  
       }else{
           $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>-100]); 
       }
       return $modificacion;
    }
    public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
               $modificacion= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
               if(isset($modificacion)){
                   if($this->scenario=='pago' && !$modificacion->pago_capital){
                       return true;
                   }
                    if($this->scenario=='aumento' && !$modificacion->aumento_capital){
                       return true;
                   }
                    if($this->scenario=='venta' && !$modificacion->venta_accion){
                       return true;
                   }
              }else{
                   return true;
               }
               }
          $certificado= Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id,'tipo_certificado'=>$this->tipo_certificado]);
           if(isset($certificado)){
               
                return true;   
            }else{
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
     public function Validardenominacion()
    {
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
           $registro=$registromodificacion;
           
           }
           $denominacion=  DenominacionesComerciales::findOne(['documento_registrado_id'=>$registro->id]);
           if(isset($denominacion)){
               if($denominacion->tipo_denominacion!="COOPERATIVA" || $denominacion->cooperativa_capital=="SUPLEMENTARIO"){
                   return false;
                   
               }else{
                   return true;
               }
           }
       }
       return false;
    }
}
