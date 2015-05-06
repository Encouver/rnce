<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.objetos_empresas".
 *
 * @property integer $id
 * @property boolean $contratista
 * @property integer $empresa_relacionada_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property boolean $productor
 * @property boolean $fabricante
 * @property boolean $fabricante_importado
 * @property boolean $distribuidor
 * @property boolean $distribuidor_autorizado
 * @property boolean $distribuidor_importador
 * @property boolean $dist_importador_aut
 * @property boolean $servicio_basico
 * @property boolean $servicio_profesional
 * @property boolean $servicio_comercial
 * @property boolean $ser_comercial_aut
 * @property boolean $obra
 * @property integer $contratista_id
 *
 * @property ObjetosAutorizaciones[] $objetosAutorizaciones
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
        return 'public.objetos_empresas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista', 'contratista_id'], 'required'],
            [['contratista', 'sys_status', 'productor', 'fabricante', 'fabricante_importado', 'distribuidor', 'distribuidor_autorizado', 'distribuidor_importador', 'dist_importador_aut', 'servicio_basico', 'servicio_profesional', 'servicio_comercial', 'ser_comercial_aut', 'obra'], 'boolean'],
            [['empresa_relacionada_id', 'contratista_id'], 'integer'],
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
            'contratista' => Yii::t('app', 'Contratista'),
            'empresa_relacionada_id' => Yii::t('app', 'Empresa Relacionada ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'productor' => Yii::t('app', 'Productor'),
            'fabricante' => Yii::t('app', 'Fabricante'),
            'fabricante_importado' => Yii::t('app', 'Fabricante Importado'),
            'distribuidor' => Yii::t('app', 'Distribuidor'),
            'distribuidor_autorizado' => Yii::t('app', 'Distribuidor Autorizado'),
            'distribuidor_importador' => Yii::t('app', 'Distribuidor Importador'),
            'dist_importador_aut' => Yii::t('app', 'Dist Importador Aut'),
            'servicio_basico' => Yii::t('app', 'Servicio Basico'),
            'servicio_profesional' => Yii::t('app', 'Servicio Profesional'),
            'servicio_comercial' => Yii::t('app', 'Servicio Comercial'),
            'ser_comercial_aut' => Yii::t('app', 'Ser Comercial Aut'),
            'obra' => Yii::t('app', 'Obra'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosAutorizaciones()
    {
        return $this->hasMany(ObjetosAutorizaciones::className(), ['objeto_empresa_id' => 'id']);
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
