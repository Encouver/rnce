<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventarios_c".
 *
 * @property integer $id
 * @property string $tecnica_medicion
 * @property string $formula_calculo
 * @property string $costo_adquisicion
 * @property string $ajuste_inflacion
 * @property string $reservo_deterioro
 * @property integer $contratista_id
 * @property string $ano
 *
 * @property Contratistas $contratista
 */
class InventariosC extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventarios_c';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tecnica_medicion', 'formula_calculo', 'costo_adquisicion', 'ajuste_inflacion', 'contratista_id'], 'required'],
            [['costo_adquisicion', 'ajuste_inflacion', 'reservo_deterioro'], 'number'],
            [['contratista_id'], 'integer'],
            [['ano'], 'safe'],
            [['tecnica_medicion', 'formula_calculo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tecnica_medicion' => 'Tecnica Medicion',
            'formula_calculo' => 'Formula Calculo',
            'costo_adquisicion' => 'Costo Adquisicion',
            'ajuste_inflacion' => 'Ajuste Inflacion',
            'reservo_deterioro' => 'Reservo Deterioro',
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}
