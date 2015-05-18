<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasCInventarios;

/**
 * CuentasCInventariosSearch represents the model behind the search form about `common\models\c\CuentasCInventarios`.
 */
class CuentasCInventariosSearch extends CuentasCInventarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_inventario_id', 'tecnica_medicion_id', 'formula_tecnica_id', 'frecuencia_rotacion', 'creado_por', 'actualizado_por'], 'integer'],
            [['detalle_inventario', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['inventario_inicial', 'compra_ejercicio', 'ventas_ejercicio', 'inventario_final', 'valor_neto_realizacion', 'variacion_inflacion', 'costo_ajustado', 'deterioro', 'reverso_deterioro', 'valor_neto_ajus_cierre'], 'number'],
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
        $query = CuentasCInventarios::find();

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
            'tipo_inventario_id' => $this->tipo_inventario_id,
            'tecnica_medicion_id' => $this->tecnica_medicion_id,
            'formula_tecnica_id' => $this->formula_tecnica_id,
            'inventario_inicial' => $this->inventario_inicial,
            'compra_ejercicio' => $this->compra_ejercicio,
            'ventas_ejercicio' => $this->ventas_ejercicio,
            'inventario_final' => $this->inventario_final,
            'valor_neto_realizacion' => $this->valor_neto_realizacion,
            'frecuencia_rotacion' => $this->frecuencia_rotacion,
            'variacion_inflacion' => $this->variacion_inflacion,
            'costo_ajustado' => $this->costo_ajustado,
            'deterioro' => $this->deterioro,
            'reverso_deterioro' => $this->reverso_deterioro,
            'valor_neto_ajus_cierre' => $this->valor_neto_ajus_cierre,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'detalle_inventario', $this->detalle_inventario]);

        return $dataProvider;
    }
}
