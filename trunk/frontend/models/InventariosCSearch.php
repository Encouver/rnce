<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InventariosC;

/**
 * InventariosCSearch represents the model behind the search form about `app\models\InventariosC`.
 */
class InventariosCSearch extends InventariosC
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id'], 'integer'],
            [['tecnica_medicion', 'formula_calculo', 'ano'], 'safe'],
            [['costo_adquisicion', 'ajuste_inflacion', 'reservo_deterioro'], 'number'],
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
        $query = InventariosC::find();

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
            'costo_adquisicion' => $this->costo_adquisicion,
            'ajuste_inflacion' => $this->ajuste_inflacion,
            'reservo_deterioro' => $this->reservo_deterioro,
            'contratista_id' => $this->contratista_id,
            'ano' => $this->ano,
        ]);

        $query->andFilterWhere(['like', 'tecnica_medicion', $this->tecnica_medicion])
            ->andFilterWhere(['like', 'formula_calculo', $this->formula_calculo]);

        return $dataProvider;
    }
}
