<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Task]].
 *
 * @see \common\models\Task
 */

class TaskQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \common\models\Task[]|array
     */

    public function all($db = null)
    {
        return parent::all();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Task|array|null
     */

    public function one($db = null)
    {
        return parent::one();
    }
}