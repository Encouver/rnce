<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CuentasCobroDudoso;

/**
 * CuentasCobroDudosoSearch represents the model behind the search form about `app\models\CuentasCobroDudoso`.
 */
class CuentasCobroDudosoSearch extends CuentasCobroDudoso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'cliente_id'], 'integer'],
            [['cta_cobrar30', 'cta_cobrar60', 'cta_cobrar90', 'cta_cobrar_m', 'estimacion', 'saldo_conta_corriente', 'saldo_conta_ncorriente'], 'number'],
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
        $query = CuentasCobroDudoso::find();

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
            'cliente_id' => $this->cliente_id,
            'cta_cobrar30' => $this->cta_cobrar30,
            'cta_cobrar60' => $this->cta_cobrar60,
            'cta_cobrar90' => $this->cta_cobrar90,
            'cta_cobrar_m' => $this->cta_cobrar_m,
            'estimacion' => $this->estimacion,
            'saldo_conta_corriente' => $this->saldo_conta_corriente,
            'saldo_conta_ncorriente' => $this->saldo_conta_ncorriente,
            'ano' => $this->ano,
        ]);

        return $dataProvider;
    }
}
