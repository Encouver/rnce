<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CuentasCobrarSprivpub;

/**
 * CuentasCobrarSprivpubSearch represents the model behind the search form about `app\models\CuentasCobrarSprivpub`.
 */
class CuentasCobrarSprivpubSearch extends CuentasCobrarSprivpub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'procentaje_a', 'plazo_contrato', 'contatista_id'], 'integer'],
            [['venta', 'servicio', 'obras'], 'boolean'],
            [['num_contrato_factura', 'ano', 'tipo_cuenta'], 'safe'],
            [['monto_contrato_f'], 'number'],
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
        $query = CuentasCobrarSprivpub::find();

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
            'venta' => $this->venta,
            'servicio' => $this->servicio,
            'obras' => $this->obras,
            'monto_contrato_f' => $this->monto_contrato_f,
            'procentaje_a' => $this->procentaje_a,
            'plazo_contrato' => $this->plazo_contrato,
            'contatista_id' => $this->contatista_id,
            'ano' => $this->ano,
        ]);

        $query->andFilterWhere(['like', 'num_contrato_factura', $this->num_contrato_factura])
            ->andFilterWhere(['like', 'tipo_cuenta', $this->tipo_cuenta]);

        return $dataProvider;
    }
}
