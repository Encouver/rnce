<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inpc".
 *
 * @property integer $id
 * @property string $ano
 * @property integer $mes
 * @property string $indice
 */
class Inpc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inpc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ano'], 'safe'],
            [['mes', 'indice'], 'required'],
            [['mes'], 'integer'],
            [['indice'], 'number'],
            [['ano', 'mes'], 'unique', 'targetAttribute' => ['ano', 'mes'], 'message' => 'The combination of Ano and Mes has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ano' => 'Ano',
            'mes' => 'Mes',
            'indice' => 'Indice',
        ];
    }
}
