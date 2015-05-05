<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\DenominacionesComerciales;

/**
 * DenominacionesComercialesSearch represents the model behind the search form about `common\models\p\DenominacionesComerciales`.
 */
class DenominacionesComercialesSearch extends DenominacionesComerciales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id'], 'integer'],
            [['codigo_situr', 'cooperativa_capital', 'cooperativa_distribuicion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'tipo_denominacion', 'tipo_subdenominacion'], 'safe'],
            [['sys_status'], 'boolean'],
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
        $query = DenominacionesComerciales::find();

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
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'codigo_situr', $this->codigo_situr])
            ->andFilterWhere(['like', 'cooperativa_capital', $this->cooperativa_capital])
            ->andFilterWhere(['like', 'cooperativa_distribuicion', $this->cooperativa_distribuicion])
            ->andFilterWhere(['like', 'tipo_denominacion', $this->tipo_denominacion])
            ->andFilterWhere(['like', 'tipo_subdenominacion', $this->tipo_subdenominacion]);

        return $dataProvider;
    }
}
