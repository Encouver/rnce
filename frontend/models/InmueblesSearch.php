<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Inmuebles;

/**
 * InmueblesSearch represents the model behind the search form about `common\models\Inmuebles`.
 */
class InmueblesSearch extends Inmuebles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id'], 'integer'],
            [['descripcion', 'direccion_ubicacion', 'ficha_catastral', 'zonificacion', 'extension', 'titulo_supletorio', 'sys_fecha'], 'safe'],
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
        $query = Inmuebles::find();

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
            'bien_id' => $this->bien_id,
            'sys_status' => $this->sys_status,
            'sys_fecha' => $this->sys_fecha,
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
