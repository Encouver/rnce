<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OtrasCuentasCobrar;

/**
 * OtrasCuentasCobrarSearch represents the model behind the search form about `app\models\OtrasCuentasCobrar`.
 */
class OtrasCuentasCobrarSearch extends OtrasCuentasCobrar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_deudor_id', 'contratista_id'], 'integer'],
            [['nombre', 'origen', 'fecha', 'garantia', 'plazo', 'ano'], 'safe'],
            [['activo'], 'boolean'],
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
        $query = OtrasCuentasCobrar::find();

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
            'tipo_deudor_id' => $this->tipo_deudor_id,
            'fecha' => $this->fecha,
            'ano' => $this->ano,
            'contratista_id' => $this->contratista_id,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'origen', $this->origen])
            ->andFilterWhere(['like', 'garantia', $this->garantia])
            ->andFilterWhere(['like', 'plazo', $this->plazo]);

        return $dataProvider;
    }
}
