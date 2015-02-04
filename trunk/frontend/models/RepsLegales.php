<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reps_legales".
 *
 * @property integer $id
 * @property integer $persona_natural_id
 * @property integer $contratista_id
 *
 * @property Contratistas $contratista
 * @property PersonasNaturales $personaNatural
 */
class RepsLegales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reps_legales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_natural_id', 'contratista_id'], 'integer'],
            [['contratista_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'persona_natural_id' => 'Persona Natural ID',
            'contratista_id' => 'Contratista ID',
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
    public function getPersonaNatural()
    {
        return $this->hasOne(PersonasNaturales::className(), ['id' => 'persona_natural_id']);
    }
}
