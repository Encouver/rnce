<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosDeterioros;

/**
 * ActivosDeteriorosSearch represents the model behind the search form about `common\models\a\ActivosDeterioros`.
 */
class ActivosDeteriorosSearch extends ActivosDeterioros
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['valor_razonable', 'costo_disposicion', 'valor_uso', 'acumulado_ejer_ant', 'ejercicios_anteriores'], 'number'],
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
        $query = ActivosDeterioros::find();

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
            'valor_razonable' => $this->valor_razonable,
            'costo_disposicion' => $this->costo_disposicion,
            'valor_uso' => $this->valor_uso,
            'acumulado_ejer_ant' => $this->acumulado_ejer_ant,
            'ejercicios_anteriores' => $this->ejercicios_anteriores,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        return $dataProvider;
    }
}
