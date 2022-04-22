<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    public static function tableName()
    {
        return 'supplier';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '厂商名',
            'code' => '厂商编码',
            't_status' => '状态'
        ];
    }

    /**
     * 状态属性
     */
    public function getStatusEnum()
    {
        return [
            'ok' => 'ok',
            'hold' => 'hold'
        ];
    }

    /**
     * 导出字段
     */
    public static function getExportFields()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'code' => 'code',
            't_status' => 't_status'
        ];
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'code', 't_status'], 'safe'],
        ];
    }

    public function search($params)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getQuery($params),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    public function getQuery($params)
    {
        $query = self::find();

        if (!($this->load($params) && $this->validate())) {
            return $query;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['t_status' => $this->t_status]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'code', $this->code]);

        return $query;
    }
}
