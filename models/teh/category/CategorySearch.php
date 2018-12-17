<?php

namespace app\models\teh\category;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\teh\category\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\teh\category\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */


    public function rules()
    {
        return [
            [['id', 'parent', 'custom_order'], 'integer'],
            [['cat_title'], 'safe'],
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
        $query = Category::find();

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
            'parent' => $this->parent,
            'custom_order' => $this->custom_order,
        ]);

        $query->andFilterWhere(['like', 'cat_title', $this->cat_title]);

        return $dataProvider;
    }
}