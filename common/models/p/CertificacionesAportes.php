<?php

namespace common\models\p;
use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "certificaciones_aportes".
 *
 * @property integer $id
 * @property integer $natural_juridica_id
 * @property string $colegiatura
 * @property string $tipo_profesion
 * @property string $fecha_informe
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $documento_registrado_id
 * @property integer $contratista_id
 *
 * @property Capitales[] $capitales
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 * @property EmpresasFusionadas[] $empresasFusionadas
 * @property LimitacionesCapitales[] $limitacionesCapitales
 */
class CertificacionesAportes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificaciones_aportes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['natural_juridica_id', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id'], 'integer'],
            [['tipo_profesion', 'fecha_informe', 'documento_registrado_id', 'contratista_id','natural_juridica_id'], 'required'],
            [['tipo_profesion'], 'string'],
            [['fecha_informe', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['colegiatura'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica'),
            'colegiatura' => Yii::t('app', 'Colegiatura'),
            'tipo_profesion' => Yii::t('app', 'Tipo Profesion'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitales()
    {
        return $this->hasMany(Capitales::className(), ['certificacion_aporte_id' => 'id']);
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
    public function getEmpresasFusionadas()
    {
        return $this->hasMany(EmpresasFusionadas::className(), ['certificacion_aporte_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitales()
    {
        return $this->hasMany(LimitacionesCapitales::className(), ['certificacion_aporte_id' => 'id']);
    }
    
     public function getFormAttribs() {
      
        
       
    $profesiones =[ 'CONTADOR PUBLICO' => 'CONTADOR PUBLICO', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'ECONOMISTA' => 'ECONOMISTA', ];
    return [
          'tipo_profesion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$profesiones , 'options'=>['prompt'=>'Seleccione profesion']],
         'colegiatura'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
       
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
}
