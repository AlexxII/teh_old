<?php

namespace app\models\teh\tool;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\teh\tool\Tool;

/**
 * ToolSearch represents the model behind the search form of `app\models\teh\tool\Tool`.
 */
class ToolSearch extends Tool
{
    public $comment;
    public $fullTitle;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'pak_id', 'parent_id', 'place_id'], 'integer'],
            [['tool_title', 'tool_manufact', 'tool_model', 'tool_serial', 'factory_date', 'break', 'fullTitle'], 'safe'],
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
      $query = Tool::find();

      $dataProvider = new ActiveDataProvider([
          'query' => $query,
      ]);
      $dataProvider->setSort([
          'attributes' => [
              'fullTitle' => [
                  'asc' => ['tool_manufact' => SORT_ASC, 'tool_model' => SORT_ASC],
                  'desc' => ['tool_manufact' => SORT_DESC, 'tool_model' => SORT_DESC],
                  'label' => 'Наименование',
                  'default' => SORT_ASC
              ],
              'place_id',
              'pak_id'
          ]
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
            'category_id' => $this->category_id,
            'pak_id' => $this->pak_id,
            'parent_id' => $this->parent_id,
            'operation_time' => $this->operation_time,
            'place_id' => $this->place_id,
            'place.comment' => $this->comment,
        ]);

        $query->andFilterWhere(['like', 'tool_title', $this->tool_title])
            ->andFilterWhere(['like', 'tool_serial', $this->tool_serial])
            ->andFilterWhere(['like', 'factory_date', $this->factory_date])
            ->andFilterWhere(['like', 'break', $this->break])
//            ->andFilterWhere(['like', 'place.comment', $this->comment])
            ->andFilterWhere(['like', 'concat_ws(" ", tool_manufact, tool_model)', $this->fullTitle ]);

        return $dataProvider;
    }
}
