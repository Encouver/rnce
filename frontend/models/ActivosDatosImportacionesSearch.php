<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosDatosImportaciones;

/**
 * ActivosDatosImportacionesSearch represents the model behind the search form about `common\models\a\ActivosDatosImportaciones`.
 */
class ActivosDatosImportacionesSearch extends ActivosDatosImportaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bien_id', 'sys_divisa_id', 'pais_origen_id'], 'integer'],
            [['num_guia_nac', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['costo_adquisicion', 'gastos_mon_extranjera', 'tasa_cambio', 'gastos_imp_nacional', 'otros_costros_imp_instalacion', 'total_costo_adquisicion'], 'number'],
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
        $query = ActivosDatosImportaciones::find();

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
            'costo_adquisicion' => $this->costo_adquisicion,
            'gastos_mon_extranjera' => $this->gastos_mon_extranjera,
            'sys_divisa_id' => $this->sys_divisa_id,
            'tasa_cambio' => $this->tasa_cambio,
            'gastos_imp_nacional' => $this->gastos_imp_nacional,
            'otros_costros_imp_instalacion' => $this->otros_costros_imp_instalacion,
            'total_costo_adquisicion' => $this->total_costo_adquisicion,
            'pais_origen_id' => $this->pais_origen_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'num_guia_nac', $this->num_guia_nac]);

        return $dataProvider;
    }
}
