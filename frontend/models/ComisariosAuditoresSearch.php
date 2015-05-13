<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ComisariosAuditores;

/**
 * ComisariosAuditoresSearch represents the model behind the search form about `common\models\p\ComisariosAuditores`.
 */
class ComisariosAuditoresSearch extends ComisariosAuditores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'documento_registrado_id', 'contratista_id', 'natural_juridica_id'], 'integer'],
            [['fecha_vencimiento', 'tipo_profesion', 'fecha_carta', 'colegiatura', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['declaracion_jurada', 'comisario', 'sys_status', 'auditor', 'responsable_contabilidad', 'informe_conversion'], 'boolean'],
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
        $query = ComisariosAuditores::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => 10,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'declaracion_jurada' => $this->declaracion_jurada,
            'fecha_carta' => $this->fecha_carta,
            'documento_registrado_id' => $this->documento_registrado_id,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'comisario' => $this->comisario,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'auditor' => $this->auditor,
            'responsable_contabilidad' => $this->responsable_contabilidad,
            'informe_conversion' => $this->informe_conversion,
            'natural_juridica_id' => $this->natural_juridica_id,
        ]);

        $query->andFilterWhere(['like', 'tipo_profesion', $this->tipo_profesion])
            ->andFilterWhere(['like', 'colegiatura', $this->colegiatura]);

        return $dataProvider;
    }
}
