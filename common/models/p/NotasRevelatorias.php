<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "notas_revelatorias".
 *
 * @property integer $id
 * @property string $nota
 * @property integer $contratista_id
 * @property integer $usuario_id
 * @property boolean $estado
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property NotasRevelatoriasCuentas[] $notasRevelatoriasCuentas
 */
class NotasRevelatorias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notas_revelatorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota', 'contratista_id', 'usuario_id', 'nombre'], 'required'],
            [['nota', 'nombre'], 'string'],
            [['contratista_id', 'usuario_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'anho'], 'safe']
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
            'nombre' => Yii::t('app', 'Nombre nota'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
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
    public function getNotasRevelatoriasCuentas()
    {
        return $this->hasMany(NotasRevelatoriasCuentas::className(), ['nota_revelatoria_id' => 'id']);
    }
}
