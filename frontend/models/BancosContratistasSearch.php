<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\BancosContratistas;

/**
 * BancosContratistasSearch represents the model behind the search form about `common\models\p\BancosContratistas`.
 */
class BancosContratistasSearch extends BancosContratistas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banco_id', 'contratista_id'], 'integer'],
            [['num_cuenta',  'estatus_cuenta', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = BancosContratistas::find();

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
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'num_cuenta', $this->num_cuenta])
            ->andFilterWhere(['like', 'tipo_moneda', $this->tipo_moneda])
            ->andFilterWhere(['like', 'tipo_cuenta', $this->tipo_cuenta])
            ->andFilterWhere(['like', 'estatus_cuenta', $this->estatus_cuenta]);

        return $dataProvider;
    }
}
