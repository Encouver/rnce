<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosConstruccionesInmuebles;

/**
 * ActivosConstruccionesInmueblesSearch represents the model behind the search form about `common\models\a\ActivosConstruccionesInmuebles`.
 */
class ActivosConstruccionesInmueblesSearch extends ActivosConstruccionesInmuebles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['area_construccion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['porcentaje_ejecucion', 'monto_ejecutado'], 'number'],
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
        $query = ActivosConstruccionesInmuebles::find();

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
            'porcentaje_ejecucion' => $this->porcentaje_ejecucion,
            'monto_ejecutado' => $this->monto_ejecutado,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'area_construccion', $this->area_construccion]);

        return $dataProvider;
    }
}
