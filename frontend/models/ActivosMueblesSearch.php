<?php

namespace app\models;

use common\models\a\ActivosBienes;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosMuebles;

/**
 * ActivosMueblesSearch represents the model behind the search form about `common\models\a\ActivosMuebles`.
 */
class ActivosMueblesSearch extends ActivosMuebles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id', 'cantidad', 'creado_por', 'actualizado_por'], 'integer'],
            [['marca', 'modelo', 'serial', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = ActivosMuebles::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$query->joinWith(ActivosBienes::tableName().' as bien');

        $query->andFilterWhere([
            'id' => $this->id,
            'bien_id' => $this->bien_id,
            'cantidad' => $this->cantidad,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'serial', $this->serial]);

        return $dataProvider;
    }
}
