<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Domicilios;

/**
 * DomiciliosSearch represents the model behind the search form about `common\models\p\Domicilios`.
 */
class DomiciliosSearch extends Domicilios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'documento_registrado_id', 'direccion_id'], 'integer'],
            [['sys_status', 'fiscal'], 'boolean'],
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
        $query = Domicilios::find();

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
            'documento_registrado_id' => $this->documento_registrado_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'fiscal' => $this->fiscal,
            'direccion_id' => $this->direccion_id,
        ]);

        return $dataProvider;
    }
}
