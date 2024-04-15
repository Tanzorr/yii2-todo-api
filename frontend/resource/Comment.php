<?php

namespace frontend\resource;

class Comment extends \common\models\Comment
{
    public function fields(): array
    {
        return [
            'id',
            'task_id',
            'body',
            'created_at',
        ];
    }

    public function extraFields(): array
    {
        return [
            'task',
        ];
    }

    public function getTask(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }


}