<?php

namespace frontend\controllers;

use frontend\resource\Comment;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class CommentController extends ActiveController
{
    public $modelClass = Comment::class;


    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider']=[$this,'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->andWhere(['task_id' => Yii::$app->request->get('task_id')])
        ]);

    }
}
