<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosInmuebles;

/**
 * ActivosInmueblesSearch represents the model behind the search form about `common\models\a\ActivosInmuebles`.
 */
class ActivosInmueblesSearch extends ActivosInmuebles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['descripcion', 'direccion_ubicacion', 'ficha_catastral', 'zonificacion', 'extension', 'titulo_supletorio', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = ActivosInmuebles::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'bien_id' => $this->bien_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'direccion_ubicacion', $this->direccion_ubicacion])
            ->andFilterWhere(['like', 'ficha_catastral', $this->ficha_catastral])
            ->andFilterWhere(['like', 'zonificacion', $this->zonificacion])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'titulo_supletorio', $this->titulo_supletorio]);

        return $dataProvider;
    }
}
