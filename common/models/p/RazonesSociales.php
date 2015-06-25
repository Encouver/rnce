<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ModificacionesActas;
use common\models\p\Contratistas;
use Yii;

/**
 * This is the model class for table "razones_sociales".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property string $nombre
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $documento_registrado_id
 *
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class RazonesSociales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'razones_sociales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'nombre', 'documento_registrado_id'], 'required'],
            [['contratista_id', 'creado_por', 'actualizado_por', 'documento_registrado_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255]
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
            'nombre' => Yii::t('app', 'Nombre'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['razon_social_id' => 'id']);
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
                   if(!$modificacion->razon_social){
                       return true;
                   }
               }else{
                   return true;
               }
           }
          $razon= RazonesSociales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($razon)){
               
                return true;   
            }else{
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
     public function Asignarnombre(){
       $contratista = Contratistas::findOne(['id'=>Yii::$app->user->identity->contratista_id]);
       return $contratista->naturalJuridica->denominacion;
        
    }
}
