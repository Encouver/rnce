<?php

namespace app;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Direcciones;

/**
 * modelsDireccionesSearch represents the model behind the search form about `common\models\p\Direcciones`.
 */
class modelsDireccionesSearch extends Direcciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sys_estado_id', 'sys_municipio_id', 'sys_parroquia_id'], 'integer'],
            [['zona', 'calle', 'casa', 'nivel', 'numero', 'referencia', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = Direcciones::find();

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
            'sys_estado_id' => $this->sys_estado_id,
            'sys_municipio_id' => $this->sys_municipio_id,
            'sys_parroquia_id' => $this->sys_parroquia_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'casa', $this->casa])
            ->andFilterWhere(['like', 'nivel', $this->nivel])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'referencia', $this->referencia]);

        return $dataProvider;
    }
}
