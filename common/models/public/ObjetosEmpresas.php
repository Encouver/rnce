<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.objetos_empresas".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $tipo_relacion
 * @property boolean $autorizacion
 * @property integer $relacion_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ObjetosAutorizaciones[] $objetosAutorizaciones
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
            [['nombre', 'tipo_relacion', 'autorizacion', 'relacion_id'], 'required'],
            [['nombre'], 'string'],
            [['tipo_relacion', 'autorizacion', 'sys_status'], 'boolean'],
            [['relacion_id'], 'integer'],
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
            'nombre' => Yii::t('app', 'Nombre'),
            'tipo_relacion' => Yii::t('app', 'Tipo Relacion'),
            'autorizacion' => Yii::t('app', 'Autorizacion'),
            'relacion_id' => Yii::t('app', 'Relacion ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosAutorizaciones()
    {
        return $this->hasMany(ObjetosAutorizaciones::className(), ['objeto_empresa_id' => 'id']);
    }
}
