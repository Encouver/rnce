<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\PersonasJuridicas;

/**
 * PersonasJuridicasSearch represents the model behind the search form about `common\models\p\PersonasJuridicas`.
 */
class PersonasJuridicasSearch extends PersonasJuridicas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creado_por','sys_pais_id'], 'integer'],
            [['rif', 'razon_social', 'numero_identificacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'tipo_nacionalidad','sys_pais_id'], 'safe'],
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
        $query = PersonasJuridicas::find();

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
            'creado_por' => $this->creado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'sys_pais_id' => $this->sys_pais_id,
        ]);

        $query->andFilterWhere(['like', 'rif', $this->rif])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'numero_identificacion', $this->numero_identificacion])
            ->andFilterWhere(['like', 'tipo_nacionalidad', $this->tipo_nacionalidad]);

        return $dataProvider;
    }
}
