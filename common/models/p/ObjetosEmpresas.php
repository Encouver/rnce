<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "objetos_empresas".
 *
 * @property integer $id
 * @property boolean $contratista
 * @property integer $empresa_relacionada_id
 * @property integer $contratista_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $objeto_empresa
 *
 * @property Contratistas $contratista0
 * @property EmpresasRelacionadas $empresaRelacionada
 */
class ObjetosEmpresas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetos_empresas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista', 'contratista_id', 'objeto_empresa'], 'required'],
            [['contratista',  'sys_status'], 'boolean'],
            [['empresa_relacionada_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['objeto_empresa'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista' => Yii::t('app', 'Contratista'),
            'empresa_relacionada_id' => Yii::t('app', 'Empresa Relacionada ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'objeto_empresa' => Yii::t('app', 'Objeto Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista0()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaRelacionada()
    {
        return $this->hasOne(EmpresasRelacionadas::className(), ['id' => 'empresa_relacionada_id']);
    }
}
