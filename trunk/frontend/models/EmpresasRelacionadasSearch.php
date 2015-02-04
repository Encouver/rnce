<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmpresasRelacionadas;

/**
 * EmpresasRelacionadasSearch represents the model behind the search form about `app\models\EmpresasRelacionadas`.
 */
class EmpresasRelacionadasSearch extends EmpresasRelacionadas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'contratista_id', 'otras_cuentas_pagar_id'], 'integer'],
            [['participacion'], 'number'],
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
        $query = EmpresasRelacionadas::find();

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
            'empresa_id' => $this->empresa_id,
            'contratista_id' => $this->contratista_id,
            'otras_cuentas_pagar_id' => $this->otras_cuentas_pagar_id,
            'participacion' => $this->participacion,
        ]);

        return $dataProvider;
    }
}
