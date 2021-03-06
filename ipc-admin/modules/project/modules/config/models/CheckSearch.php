<?php

namespace ipc\modules\project\modules\config\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ipc\modules\project\modules\config\models\Check;

/**
 * CheckSearch represents the model behind the search form about `ipc\modules\project\modules\config\models\Check`.
 */
class CheckSearch extends Check
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['check_id', 'status'], 'integer'],
            [['title', 'code', 'remark'], 'safe'],
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
        $query = Check::find();

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
            'check_id' => $this->check_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
