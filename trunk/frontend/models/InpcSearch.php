<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inpc;

/**
 * InpcSearch represents the model behind the search form about `app\models\Inpc`.
 */
class InpcSearch extends Inpc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mes'], 'integer'],
            [['ano'], 'safe'],
            [['indice'], 'number'],
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
        $query = Inpc::find();

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
            'ano' => $this->ano,
            'mes' => $this->mes,
            'indice' => $this->indice,
        ]);

        return $dataProvider;
    }
}
