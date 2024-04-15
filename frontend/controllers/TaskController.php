<?php

namespace frontend\controllers;

use frontend\resource\Task;
use yii\web\ForbiddenHttpException;

class TaskController extends ApiController
{
    public $modelClass = Task::class;


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