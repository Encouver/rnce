<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\CertificadosDisminuidos;

/**
 * CertificadosDisminuidosSearch represents the model behind the search form about `common\models\p\CertificadosDisminuidos`.
 */
class CertificadosDisminuidosSearch extends CertificadosDisminuidos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'numero_asociacion_actual', 'numero_aportacion_actual', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['justificacion', 'tipo_disminucion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion', 'valor_asociacion_actual', 'valor_aportacion_actual', 'valor_rotativo_actual', 'valor_inversion_actual', 'numero_rotativo_actual', 'numero_inversion_actual', 'capital_social'], 'number'],
            [['sys_status', 'actual'], 'boolean'],
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
        $query = CertificadosDisminuidos::find();

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
            'valor_asociacion' => $this->valor_asociacion,
            'valor_aportacion' => $this->valor_aportacion,
            'valor_rotativo' => $this->valor_rotativo,
            'valor_inversion' => $this->valor_inversion,
            'numero_asociacion' => $this->numero_asociacion,
            'numero_aportacion' => $this->numero_aportacion,
            'numero_rotativo' => $this->numero_rotativo,
            'numero_inversion' => $this->numero_inversion,
            'valor_asociacion_actual' => $this->valor_asociacion_actual,
            'valor_aportacion_actual' => $this->valor_aportacion_actual,
            'valor_rotativo_actual' => $this->valor_rotativo_actual,
            'valor_inversion_actual' => $this->valor_inversion_actual,
            'numero_asociacion_actual' => $this->numero_asociacion_actual,
            'numero_aportacion_actual' => $this->numero_aportacion_actual,
            'numero_rotativo_actual' => $this->numero_rotativo_actual,
            'numero_inversion_actual' => $this->numero_inversion_actual,
            'capital_social' => $this->capital_social,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'actual' => $this->actual,
        ]);

        $query->andFilterWhere(['like', 'justificacion', $this->justificacion])
            ->andFilterWhere(['like', 'tipo_disminucion', $this->tipo_disminucion]);

        return $dataProvider;
    }
}
