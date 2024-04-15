<?php

namespace frontend\resource;

use yii\db\ActiveQuery;

class Task extends \common\models\Task
{

    public function fields(): array
    {
        return [
            'id',
            'title',
            'body',
            'created_at',
            'comments',
        ];
    }

    public function extraFields(): array
    {
        return [
            'comments',
            'created_at',
            'updated_at',
            'created_by',
        ];
    }

    /**
     * @return ActiveQuery
     */

    public function getComments(): ActiveQuery
    {
       return $this->hasMany(Comment::class, ['task_id' => 'id']);
    }
}