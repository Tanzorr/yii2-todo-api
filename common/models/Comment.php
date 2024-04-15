<?php

namespace common\models;

use common\models\query\CommentQuery;
use frontend\resource\Task;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\ForbiddenHttpException;
use function Symfony\Component\String\s;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $body
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 *
 * @property Task $task
 * @property User $createdBy
 */

class Comment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%comment}}';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            [
                'class'=>BlameableBehavior::class,
                'updatedByAttribute'=>false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','task_id'],'required'],
            [['body'],'string'],
            [['task_id','created_at', 'updated_at', 'created_by'], 'integer'],
            [['title'], 'string', 'max'=>512],
            [['task_id'],'exist','skipOnError'=>true,'targetClass'=>Task::class,'targetAttribute'=>['task_id'=>'id']],
            [['created_by'],'exist','skipOnError'=>true,'targetClass'=>User::class,'targetAttribute'=>['created_by'=>'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'=>'ID',
            'title'=>'Title',
            'body'=>'Body',
            'task_id'=>'Task ID',
            'created_at'=>'Created At',
            'updated_at'=>'Updated At',
            'created_by'=>'Created By',
        ];
    }

    /**
     * @return ActiveQuery
     */

    public function getTask(): ActiveQuery
    {
        return $this->hasOne(Task::class, ['id'=>'task_id']);
    }

    /**
     * @return ActiveQuery
     */

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id'=>'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return CommentQuery the active query used by this AR class.
     */

    public static function find(): CommentQuery
    {
      return  new CommentQuery(get_called_class());
    }

    /**
     * @param string $action
     * @param Task $model
     * @param array $params
     * @throws ForbiddenHttpException
     */

    public function checkAccess($action, $model = null, $params = []): void
    {
        if ($action === 'update' || $action === 'delete') {
            if ($model->created_by !== \Yii::$app->user->id) {
                throw new \yii\web\ForbiddenHttpException('You can only ' . $action . ' tasks that you have created.');
            }
        }
    }
}


