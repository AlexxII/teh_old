<?php

namespace app\models\teh\complex;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\teh\complex\Complex;

/**
 * ComplexSearch represents the model behind the search form of `app\models\teh\complex\Complex`.
 */
class ComplexSearch extends Complex
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'place_id', 'category_id', 'user_id'], 'integer'],
            [['complex_title', 'exploitation_date', 'ip', 'soft_version', 'break'], 'safe'],
            [['operation_time'], 'number'],
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
        $query = Complex::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'operation_time' => $this->operation_time,
            'place_id' => $this->place_id,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'complex_title', $this->complex_title])
            ->andFilterWhere(['like', 'exploitation_date', $this->exploitation_date])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'soft_version', $this->soft_version])
            ->andFilterWhere(['like', 'break', $this->break]);

        return $dataProvider;
    }
}
