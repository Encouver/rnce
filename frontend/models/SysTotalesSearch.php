<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\SysTotales;

/**
 * SysTotalesSearch represents the model behind the search form about `common\models\c\SysTotales`.
 */
class SysTotalesSearch extends SysTotales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_classname', 'contratista_id'], 'integer'],
            [['classname', 'valor', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'ahno'], 'safe'],
            [['sys_status', 'total'], 'boolean'],
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
        $query = SysTotales::find();

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
            'id_classname' => $this->id_classname,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'classname', $this->classname])
            ->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'ahno', $this->ahno]);

        return $dataProvider;
    }
}
