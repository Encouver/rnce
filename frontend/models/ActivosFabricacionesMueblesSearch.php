<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosFabricacionesMuebles;

/**
 * ActivosFabricacionesMueblesSearch represents the model behind the search form about `common\models\a\ActivosFabricacionesMuebles`.
 */
class ActivosFabricacionesMueblesSearch extends ActivosFabricacionesMuebles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id'], 'integer'],
            [['cantidad', 'porcentaje_fabricacion', 'monto_ejecutado'], 'number'],
            [['sys_status'], 'boolean'],
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
        $query = ActivosFabricacionesMuebles::find();

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
            'cantidad' => $this->cantidad,
            'porcentaje_fabricacion' => $this->porcentaje_fabricacion,
            'monto_ejecutado' => $this->monto_ejecutado,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        return $dataProvider;
    }
}
