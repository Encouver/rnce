<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotasRevelatorias;

/**
 * NotasRevelatoriasSearch represents the model behind the search form about `app\models\NotasRevelatorias`.
 */
class NotasRevelatoriasSearch extends NotasRevelatorias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'contratista_id', 'cuenta'], 'integer'],
            [['nota', 'ano'], 'safe'],
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
        $query = NotasRevelatorias::find();

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
            'usuario_id' => $this->usuario_id,
            'contratista_id' => $this->contratista_id,
            'ano' => $this->ano,
            'cuenta' => $this->cuenta,
        ]);

        $query->andFilterWhere(['like', 'nota', $this->nota]);

        return $dataProvider;
    }
}
