<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.notas_revelatorias".
 *
 * @property integer $id
 * @property string $nota
 * @property integer $contratista_id
 * @property integer $usuario_id
 * @property boolean $estado
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property NotasRevelatoriasCuentas[] $notasRevelatoriasCuentas
 * @property Contratistas $contratista
 */
class NotasRevelatorias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.notas_revelatorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota', 'contratista_id', 'usuario_id'], 'required'],
            [['nota'], 'string'],
            [['contratista_id', 'usuario_id'], 'integer'],
            [['estado', 'sys_status'], 'boolean'],
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
            'nota' => Yii::t('app', 'Nota'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'estado' => Yii::t('app', 'Estado'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasRevelatoriasCuentas()
    {
        return $this->hasMany(NotasRevelatoriasCuentas::className(), ['nota_revelatoria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}
