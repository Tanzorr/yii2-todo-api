<?php

namespace frontend\components;
class CorsMiddleware extends \yii\filters\Cors
{
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors'=>[
                    'Origin' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Expose-Headers' => ['*'],
                    'Access-Control-Max-Age' => 3600,
                ]
            ]
        ];
    }


}