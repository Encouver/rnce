<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ActividadesEconomicas;

/**
 * ActividadesEconomicasSearch represents the model behind the search form about `common\models\p\ActividadesEconomicas`.
 */
class ActividadesEconomicasSearch extends ActividadesEconomicas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contratista_id', 'ppal_experiencia', 'comp1_experiencia', 'comp2_experiencia'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = ActividadesEconomicas::find();

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
            'ppal_caev_id' => $this->ppal_caev_id,
            'comp1_caev_id' => $this->comp1_caev_id,
            'comp2_caev_id' => $this->comp2_caev_id,
            'contratista_id' => $this->contratista_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'ppal_experiencia' => $this->ppal_experiencia,
            'comp1_experiencia' => $this->comp1_experiencia,
            'comp2_experiencia' => $this->comp2_experiencia,
        ]);

        return $dataProvider;
    }
}
