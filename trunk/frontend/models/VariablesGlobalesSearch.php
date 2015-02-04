<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VariablesGlobales;

/**
 * VariablesGlobalesSearch represents the model behind the search form about `app\models\VariablesGlobales`.
 */
class VariablesGlobalesSearch extends VariablesGlobales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'cuenta_afectada'], 'integer'],
            [['campo', 'valor', 'ano'], 'safe'],
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
        $query = VariablesGlobales::find();

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
            'contratista_id' => $this->contratista_id,
            'cuenta_afectada' => $this->cuenta_afectada,
            'ano' => $this->ano,
        ]);

        $query->andFilterWhere(['like', 'campo', $this->campo])
            ->andFilterWhere(['like', 'valor', $this->valor]);

        return $dataProvider;
    }
}
