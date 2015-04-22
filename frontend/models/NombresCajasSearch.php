<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NombresCajas;

/**
 * NombresCajasSearch represents the model behind the search form about `common\models\NombresCajas`.
 */
class NombresCajasSearch extends NombresCajas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratistas_id'], 'integer'],
            [['nombre', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'tipo_caja'], 'safe'],
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
        $query = NombresCajas::find();

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
            'contratistas_id' => $this->contratistas_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'tipo_caja', $this->tipo_caja]);

        return $dataProvider;
    }
}
