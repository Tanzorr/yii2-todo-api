<?php

namespace frontend\controllers;

use frontend\resource\Comment;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;


class CommentController extends ApiController
{
    public $modelClass = Comment::class;


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
