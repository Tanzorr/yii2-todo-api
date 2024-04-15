<?php

namespace frontend\controllers;

use frontend\resource\Task;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];
        return $behaviors;
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