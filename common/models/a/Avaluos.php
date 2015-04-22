<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.avaluos".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $valor
 * @property string $fecha_informe
 * @property integer $perito_id
 * @property integer $gremio_id
 * @property string $num_inscripcion_gremio
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Bienes $bien
 * @property SysGremios $gremio
 * @property PersonasNaturales $perito
 */
class Avaluos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.avaluos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'valor', 'fecha_informe', 'perito_id', 'gremio_id', 'num_inscripcion_gremio'], 'required'],
            [['bien_id', 'perito_id', 'gremio_id'], 'integer'],
            [['valor'], 'number'],
            [['fecha_informe', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['num_inscripcion_gremio'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'valor' => Yii::t('app', 'Valor'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
            'perito_id' => Yii::t('app', 'Perito ID'),
            'gremio_id' => Yii::t('app', 'Gremio ID'),
            'num_inscripcion_gremio' => Yii::t('app', 'Num Inscripcion Gremio'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGremio()
    {
        return $this->hasOne(SysGremios::className(), ['id' => 'gremio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerito()
    {
        return $this->hasOne(PersonasNaturales::className(), ['id' => 'perito_id']);
    }
}
