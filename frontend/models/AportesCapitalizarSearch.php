<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\AportesCapitalizar;

/**
 * AportesCapitalizarSearch represents the model behind the search form about `common\models\p\AportesCapitalizar`.
 */
class AportesCapitalizarSearch extends AportesCapitalizar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id', 'certificacion_aporte_id'], 'integer'],
            [['monto_aporte'], 'number'],
            [['fecha_capitalizacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_informe'], 'safe'],
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
        $query = AportesCapitalizar::find();

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
            'monto_aporte' => $this->monto_aporte,
            'fecha_capitalizacion' => $this->fecha_capitalizacion,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'certificacion_aporte_id' => $this->certificacion_aporte_id,
            'fecha_informe' => $this->fecha_informe,
        ]);

        return $dataProvider;
    }
}
