<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\AEfectivosCajas;

/**
 * AEfectivosCajasSearch represents the model behind the search form about `common\models\c\AEfectivosCajas`.
 */
class AEfectivosCajasSearch extends AEfectivosCajas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombre_caja_id', 'tipo_moneda_id', 'total_id', 'contratista_id', 'creado_por'], 'integer'],
            [['saldo_cierre_ae', 'monto_me', 'tipo_cambio_cierre'], 'number'],
            [['nacional', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'anho'], 'safe'],
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
        $query = AEfectivosCajas::find();

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
            'nombre_caja_id' => $this->nombre_caja_id,
            'saldo_cierre_ae' => $this->saldo_cierre_ae,
            'tipo_moneda_id' => $this->tipo_moneda_id,
            'monto_me' => $this->monto_me,
            'tipo_cambio_cierre' => $this->tipo_cambio_cierre,
            'nacional' => $this->nacional,
            'total_id' => $this->total_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
