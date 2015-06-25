<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use kartik\builder\Form;
use common\models\p\ModificacionesActas;
use Yii;

/**
 * This is the model class for table "public.objetos_sociales".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property string $tipo_objeto
 * @property string $descripcion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property Contratistas $contratista
 * @property DocumentosRegistrados $documentoRegistrado
 */
class ObjetosSociales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.objetos_sociales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'documento_registrado_id', 'descripcion'], 'required'],
            [['contratista_id', 'documento_registrado_id'], 'integer'],
            [['tipo_objeto', 'descripcion'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_objeto'], 'required','on'=>'modificacion'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
            'tipo_objeto' => Yii::t('app', 'Tipo Objeto'),
            'descripcion' => Yii::t('app', 'Objeto Social'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['objeto_social_id' => 'id']);
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
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }
      public function getFormAttribs() {
        
    if($this->scenario=="modificacion"){
        $data=['AMPLIACION' => 'AMPLIACION', 'MODIFICACION PARCIAL' => 'MODIFICACION PARCIAL', 'MODIFICACION TOTAL' => 'MODIFICACION TOTAL', ];
         return [
        
        'tipo_objeto'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data,'options'=>['prompt'=>'Seleccione tipo']],
        'descripcion'=>['type'=>Form::INPUT_TEXTAREA,'options'=>['placeholder'=>'Introduzca descripcion']],
             ];
    }else{
    
         return [             
      
        'descripcion'=>['type'=>Form::INPUT_TEXTAREA,'options'=>['placeholder'=>'Introduzca descripcion']],
      
    ];
    }
       
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
                   if(!$modificacion->objeto_social){
                       return true;
                   }
               }else{
                   return true;
               }
               $this->scenario="modificacion";
           }else{
                 $this->tipo_objeto='PRINCIPAL';
           }
          $objeto= ObjetosSociales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($objeto)){
               
                return true;   
            }else{
                
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
}
