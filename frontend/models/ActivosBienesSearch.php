<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosBienes;

/**
 * ActivosBienesSearch represents the model behind the search form about `common\models\a\ActivosBienes`.
 */
class ActivosBienesSearch extends ActivosBienes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sys_tipo_bien_id', 'contratista_id', 'origen_id', 'creado_por', 'actualizado_por', 'factura_id', 'documento_registrado_id', 'arrendamiento_id', 'desincorporacion_id', 'metodo_medicion_id'], 'integer'],
            [['detalle', 'fecha_origen', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['propio', 'nacional', 'carga_completa', 'sys_status', 'mejora', 'perdida_reverso', 'proc_productivo', 'directo', 'proc_ventas'], 'boolean'],
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
        $query = ActivosBienes::find()->where(['desincorporacion_id'=>null]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $this->desincorporacion_id = null;
        $query->andFilterWhere([
            'id' => $this->id,
            'sys_tipo_bien_id' => $this->sys_tipo_bien_id,
            'fecha_origen' => $this->fecha_origen,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'propio' => $this->propio,
            'origen_id' => $this->origen_id,
            'nacional' => $this->nacional,
            'carga_completa' => $this->carga_completa,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'factura_id' => $this->factura_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'arrendamiento_id' => $this->arrendamiento_id,
            'desincorporacion_id' => $this->desincorporacion_id,
            'mejora' => $this->mejora,
            'perdida_reverso' => $this->perdida_reverso,
            'proc_productivo' => $this->proc_productivo,
            'directo' => $this->directo,
            'proc_ventas' => $this->proc_ventas,
            'metodo_medicion_id' => $this->metodo_medicion_id,
        ]);

        $query->andFilterWhere(['like', 'detalle', $this->detalle]);

        return $dataProvider;
    }
}
