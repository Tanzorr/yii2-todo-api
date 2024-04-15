<?php

namespace common\models\query;

use common\models\Comment;

/**
 * This is the ActiveQuery class for [[\common\models\Comment]].
 *
 * @see \common\models\Comment
 */

class CommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
      return $this->andWhere('[[status]]=1')
    }*/

    /**
     * {@inheritdoc}
     * @return Comment[]|array
     */

    public function all($db = null)
    {
        return parent::all();
    }

    /**
     * {@inheritdoc}
     * @return Comment|array|null
     */

    public function one($db = null)
    {
        return parent::one();
    }
}