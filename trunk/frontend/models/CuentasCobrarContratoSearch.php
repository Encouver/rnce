<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CuentasCobrarContrato;

/**
 * CuentasCobrarContratoSearch represents the model behind the search form about `app\models\CuentasCobrarContrato`.
 */
class CuentasCobrarContratoSearch extends CuentasCobrarContrato
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'plazo_contrato', 'contratista_id', 'cliente_id'], 'integer'],
            [['condiciones', 'num_contrato', 'ano'], 'safe'],
            [['porcentaje_avance', 'saldo_cont_corriente', 'saldo_cont_ncorriente'], 'number'],
            [['contrato'], 'boolean'],
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
        $query = CuentasCobrarContrato::find();

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
            'porcentaje_avance' => $this->porcentaje_avance,
            'plazo_contrato' => $this->plazo_contrato,
            'saldo_cont_corriente' => $this->saldo_cont_corriente,
            'saldo_cont_ncorriente' => $this->saldo_cont_ncorriente,
            'contratista_id' => $this->contratista_id,
            'ano' => $this->ano,
            'cliente_id' => $this->cliente_id,
            'contrato' => $this->contrato,
        ]);

        $query->andFilterWhere(['like', 'condiciones', $this->condiciones])
            ->andFilterWhere(['like', 'num_contrato', $this->num_contrato]);

        return $dataProvider;
    }
}
