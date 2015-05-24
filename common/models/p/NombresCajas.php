<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "nombres_cajas".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $nacional
 * @property string $tipo_caja
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasAEfectivosCajas[] $cuentasAEfectivosCajas
 * @property Contratistas $contratista
 */
class NombresCajas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nombres_cajas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_caja', 'contratista_id', 'anho'], 'required'],
            [['nacional', 'sys_status'], 'boolean'],
            [['contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre', 'tipo_caja'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100],
            [['nombre'], 'unique', 'targetAttribute' => ['nombre', 'tipo_caja', 'contratista_id', 'nacional']]
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
            'nacional' => Yii::t('app', 'Nacional'),
            'tipo_caja' => Yii::t('app', 'Tipo Caja'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
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
    public function getCuentasAEfectivosCajas()
    {
        return $this->hasMany(CuentasAEfectivosCajas::className(), ['nombre_caja_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}
