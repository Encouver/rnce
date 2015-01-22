<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\inversiones;

/**
 * InversionesSearch represents the model behind the search form about `app\models\inversiones`.
 */
class InversionesSearch extends inversiones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banco_id', 'contratista_id'], 'integer'],
            [['condiciones', 'ano'], 'safe'],
            [['costo_adquisicion', 'valor_desvalorizacion', 'saldo_contabilidad'], 'number'],
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
        $query = inversiones::find();

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
            'banco_id' => $this->banco_id,
            'costo_adquisicion' => $this->costo_adquisicion,
            'valor_desvalorizacion' => $this->valor_desvalorizacion,
            'saldo_contabilidad' => $this->saldo_contabilidad,
            'contratista_id' => $this->contratista_id,
            'ano' => $this->ano,
        ]);

        $query->andFilterWhere(['like', 'condiciones', $this->condiciones]);

        return $dataProvider;
    }
}
