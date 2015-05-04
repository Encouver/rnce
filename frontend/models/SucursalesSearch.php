<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Sucursales;

/**
 * SucursalesSearch represents the model behind the search form about `common\models\p\Sucursales`.
 */
class SucursalesSearch extends Sucursales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_natural_id', 'direccion_id', 'contratista_id', 'id'], 'integer'],
            [['sys_status', 'representante', 'accionista'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = Sucursales::find();

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
            'persona_natural_id' => $this->persona_natural_id,
            'direccion_id' => $this->direccion_id,
            'contratista_id' => $this->contratista_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'id' => $this->id,
            'representante' => $this->representante,
            'accionista' => $this->accionista,
        ]);

        return $dataProvider;
    }
}
