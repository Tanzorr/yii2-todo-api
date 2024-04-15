<?php

namespace frontend\controllers;

use frontend\components\CorsMiddleware;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];
        $behaviors['corsFilter'] = CorsMiddleware::class;

        return $behaviors;
    }
}