<?php

namespace common\models;

use common\models\query\TaskQuery;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property int $id
 * @property  string $title
 * @property  string $body
 * @property  int $created_at
 * @property  int $updated_at
 * @property  int $created_by
 *
 * @property Comment[] $comments
 * @property User $createdBy
 */
class Task extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%task}}';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at', 'created_by'], 'integer'],
            [['title'], 'string', 'max' => 512],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }


    /**
     * @return ActiveQuery
     */

    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['task_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new TaskQuery(get_called_class());
    }

}