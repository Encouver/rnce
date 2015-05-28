<?php

namespace common\models\p;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use common\models\p\SysCaev;
use common\models\a\ActivosDocumentosRegistrados;
use Yii;

/**
 * This is the model class for table "actividades_economicas".
 *
 * @property integer $id
 * @property integer $ppal_caev_id
 * @property integer $comp1_caev_id
 * @property integer $comp2_caev_id
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $ppal_experiencia
 * @property integer $comp1_experiencia
 * @property integer $comp2_experiencia
 * @property integer $documento_registrado_id
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 * @property SysCaev $ppalCaev
 * @property SysCaev $comp1Caev
 * @property SysCaev $comp2Caev
 */
class ActividadesEconomicas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividades_economicas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contratista_id', 'ppal_experiencia', 'comp1_experiencia','comp2_experiencia', 'documento_registrado_id'], 'required'],
            [['ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contratista_id', 'ppal_experiencia', 'comp1_experiencia', 'comp2_experiencia', 'documento_registrado_id'], 'integer'],
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
            'ppal_caev_id' => Yii::t('app', 'Ppal Caev ID'),
            'comp1_caev_id' => Yii::t('app', 'Comp1 Caev ID'),
            'comp2_caev_id' => Yii::t('app', 'Comp2 Caev ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'ppal_experiencia' => Yii::t('app', 'Experiencia principal'),
            'comp1_experiencia' => Yii::t('app', 'Experiencia complementaria 1'),
            'comp2_experiencia' => Yii::t('app', 'Experiencia complementaria 2'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpalCaev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'ppal_caev_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp1Caev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'comp1_caev_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp2Caev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'comp2_caev_id']);
    }
    
    public function getFormAttribs() {
      
        
       
    return [
            'ppal_caev_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=> ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),'options'=>['prompt'=>'Seleccione actividad']],
            'ppal_experiencia'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Años experiencias']],
            'comp1_caev_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=> ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),'options'=>['prompt'=>'Seleccione actividad']],
            'comp1_experiencia'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Años experiencias']],
            'comp2_caev_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=> ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),'options'=>['prompt'=>'Seleccione actividad']],
            'comp2_experiencia'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Años experiencias']],
          
      
    ];
    
    
    }
    public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
           }
          $actividad= ActividadesEconomicas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($actividad)){
               
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
