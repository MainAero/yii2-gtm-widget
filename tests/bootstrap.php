<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@tests', __DIR__);

$config = [
    'id' => 'test',
    'basePath' => dirname(__DIR__),
];
(new mainaero\yii\gtm\stubs\ApplicationStub($config));
