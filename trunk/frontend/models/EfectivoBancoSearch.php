<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EfectivoBanco;

/**
 * EfectivoBancoSearch represents the model behind the search form about `app\models\EfectivoBanco`.
 */
class EfectivoBancoSearch extends EfectivoBanco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'banco_id'], 'integer'],
            [['saldo_banco', 'depos_transito', 'saldo_contabilidad', 'che_transito', 'nd_contabilizadas', 'nc_contabilizadas'], 'number'],
            [['ano'], 'safe'],
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
        $query = EfectivoBanco::find();

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
            'banco_id' => $this->banco_id,
            'saldo_banco' => $this->saldo_banco,
            'depos_transito' => $this->depos_transito,
            'saldo_contabilidad' => $this->saldo_contabilidad,
            'che_transito' => $this->che_transito,
            'nd_contabilizadas' => $this->nd_contabilizadas,
            'nc_contabilizadas' => $this->nc_contabilizadas,
            'ano' => $this->ano,
        ]);

        return $dataProvider;
    }
}
