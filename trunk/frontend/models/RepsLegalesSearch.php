<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RepsLegales;

/**
 * RepsLegalesSearch represents the model behind the search form about `app\models\RepsLegales`.
 */
class RepsLegalesSearch extends RepsLegales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'persona_natural_id', 'contratista_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RepsLegales::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'persona_natural_id' => $this->persona_natural_id,
            'contratista_id' => $this->contratista_id,
        ]);

        return $dataProvider;
    }
}
